<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\video;
use App\Models\videos_locale;
use Vimeo\Laravel\Facades\Vimeo;
use Carbon\Carbon;
use Storage;
use Image;

class syncVideoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videodata:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function query($path) {
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
            $fields = explode("/", $item['link']);
            dd($item);
            //echo "Video: $id\r\n";
            $link = $fields[3];
            if(isset($fields[3])) {
                $link .= '/'.$fields[4];
            }

            $video = video::where('link', $link)->first();

            $url = $item['pictures']['sizes'][3]['link_with_play_button'];
            $contents = file_get_contents($url);
            
            $newthumb = '/thumb/'.uniqid().'.png';
            
            
            $img = Image::make($contents);
            //640, 360
            
            $img->fit(640, 360, function ($constraint) {
                $constraint->aspectRatio();
            });

            $res = Storage::put($newthumb, $img->encode('png'));
            
            if($video) {
                $video->update([
                    'link_preview' => '/storage'.$newthumb,
                ]);
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
        $path = '/me/videos';
        while ($path) {
            $path = $this->query($path);
        }
    }
}
