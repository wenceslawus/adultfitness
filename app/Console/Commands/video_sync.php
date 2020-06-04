<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\video;
use App\Models\videos_locale;
use Vimeo\Laravel\Facades\Vimeo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class video_sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync video with Vimeo Account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function parsePage($path){
      echo "Parse page: $path\r\n";
dd($path);
      $result = Vimeo::request($path,  [], 'GET');
      $connectedVideo = video::get();

      if (!isset($result['body']) && !isset($result['body']['data'])) {
        return response()->json(['errors' => ['service Vimeo not available']], 500);
      }

      if (isset($result['body']['error'])) {
        return response()->json(['errors' => $result['body']['error']], 500);
      }

      $vdata = $result['body'];
      $vimeos = $vdata['data'];
      foreach ($vimeos as $item) {
        $link = $item['link'];
        $offset = strpos($link, 'com/');
        $id = substr($link, $offset + 4);
        $firstPart = explode('/', $id)[0];
        $video_exist = null;
        foreach ($connectedVideo as $video) {
          if (explode('/', $video->link)[0] == $firstPart) {
            $video_exist = $video;
          }
        }

        $fields = [
          'embed' => $item['embed']['html'],
          'link' => $id,
          'link_preview' => $item['pictures']['sizes'][3]['link_with_play_button'],
          'likes' => 0,
          'dislikes' => 0,
          'shares' => 0,
          'views' => 0,
          'comments' => 0,
          'duration' => $item['duration'],
          'created_at' => Carbon::parse($item['release_time']),
          'updated_at' => Carbon::parse($item['modified_time']),
          'params' => 0
        ];

        $locales = [
          new videos_locale(['locale' => 'ru', 'title' => $item['name'], 'content' => ''.$item['description'], 'meta_desc' => '', 'meta_keyword' => '']),
          new videos_locale(['locale' => 'en', 'title' => $item['name'], 'content' => ''.$item['description'], 'meta_desc' => '', 'meta_keyword' => '']),
        ];

        if (!$video_exist) {
          $model = new video($fields);
          $model->save();
          $model->locales()->saveMany($locales);
        }else {
          $fields['params'] = $video_exist->params - 1;
          $video_exist->update($fields);
        }
      }

      return $vdata['paging']['next'];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
      $videos = video::get();

      foreach($videos as $video) {
        $video->update([
          'params' => $video->params | 1
        ]);
      }

      $path = '/me/videos';

      while ($path) {
        $path = $this->parsePage($path);
      }

      $unused = video::where(DB::RAW("params & 1"), 1)->get()
        ->each(function ($item){
          $item->delete();
        });
    }
}
