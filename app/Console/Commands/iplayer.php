<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\video;

class iplayer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iplayer:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update video parameters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
			$ids = Video::whereNotNull('iplayerId')->pluck('iplayerId');
			
			if(count($ids)) {
				$client = new \GuzzleHttp\Client();
				$cookie = new \GuzzleHttp\Cookie\CookieJar();

				// Authorise
				$response = $client->request('POST', 'https://iplayerhd.com/cms/login', [
					'cookies' => $cookie,
					'form_params' => [
						'username' => 'adultfitness1@gmail.com',
						'password' => 'adultfitness5675'
					]
				]);
				
				$response = $client->request( 'GET', "https://iplayerhd.com/cms/videos?sortBy=createdAt:-1", [
					'cookies' => $cookie,
				]);
				
				$videos = json_decode($response->getBody()->getContents());
				
				foreach($ids as $id) {
					foreach($videos as $videoDef) {
						$response = $client->request( 'GET', 'https://iplayerhd.com/cms/videos/'.$videoDef->id, [
							'cookies' => $cookie,
						]);
						
						$video = json_decode($response->getBody()->getContents());
						
						if($video->videoStreams->{700}->parentFileId == $id) {
							$model = video::where('iplayerId', $id)->first();
							$model->update([
								'link' => '//iplayerhd.com/player/video/' . $video->guid,
								'link_preview' => '//d24p1atj6s5nd5.cloudfront.net/assets-server/1/thumbnails/play/'.$video->thumbnailUrl.'?width=640',
								'iplayerId' => null
							]);
						}
					}
				}
				

				$response = $client->request( 'GET', 'https://iplayerhd.com/cms/logout', [
					'cookies' => $cookie,
				]);
			}		
			
    }
}
