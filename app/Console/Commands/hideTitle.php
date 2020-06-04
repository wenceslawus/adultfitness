<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vimeo\Laravel\Facades\Vimeo;
use App\Models\video;

class hideTitle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:name';

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
            $id = explode("/", $item['uri'])[2];
            echo "Video: $id\r\n";
            $video = Vimeo::request("/videos/$id", [
                //'name' => "{$user->name} ({$user->email})",
                //'description' => 'Uploaded by application',
                'privacy' => ['view' => 'unlisted'],
                "embed" => [
                    "buttons" => [
                        "like" => false,
                        "watchlater" => false,
                        "share" => false,
                        "embed" => false,
                        "hd" => false,
                        "fullscreen" => true,
                        "scaling" => true,
                    ],
                    "logos" => [
                        "vimeo" => false,
                        "custom" => [
                            "active" => true,
                            "link" => null,
                            "sticky" => false,
                        ]
                    ],
                    "title" => [
                        "name" => 'hide',
                        "owner" => 'hide',
                        "portrait" => 'hide',
                    ]
                ]
            ], 'PATCH');
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
