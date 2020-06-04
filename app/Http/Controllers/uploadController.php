<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\video;
use App\Models\videos_locale;
use Vimeo\Laravel\Facades\Vimeo;
use Carbon\Carbon;

class uploadController extends Controller
{
    public function upload(Request $request)
    {
        $user = $request->user();

        if ($user->role == 'admin' || $user->role == 'trainer') {
            if ($user->upload) {
                $upload = $user->upload;
                // remove old uploader
                Vimeo::request("/videos/{$upload->video_id}", [], 'DELETE');
                $upload->delete();
            }

            $response = Vimeo::request("/me/videos", [], 'POST');

            if (isset($response['body']) && isset($response['body']['uri'])) {
                $body = $response['body'];
                $params = explode('/', $body['uri']);

                if (isset($params[2]) && $params[2]) {
                    $id = $params[2];
                    $link = $body['upload']['upload_link'];
                    $data = parse_url($link);
                    parse_str($data['query'], $params);
                    $point = explode("?", $link)[0];

                    $upload_link = $point;

                    $uitem = $user->upload()->create([
                        'video_id'    => $id,
                        'upload_link' => $upload_link
                    ]);

                    // Update names
                    $video = Vimeo::request("/videos/$id", [
                        'name'        => "{$user->name} ({$user->email})",
                        'description' => 'Uploaded by application',
                        'privacy'     => ['view' => 'unlisted'],
                        "embed"       => [
                            "buttons" => [
                                "like"       => false,
                                "watchlater" => false,
                                "share"      => false,
                                "embed"      => false,
                                "hd"         => false,
                                "fullscreen" => true,
                                "scaling"    => true,
                            ],
                            "logos"   => [
                                "vimeo"  => false,
                                "custom" => [
                                    "active" => true,
                                    "link"   => null,
                                    "sticky" => false,
                                ]
                            ],
                            "title"   => [
                                "name"     => 'hide',
                                "owner"    => 'hide',
                                "portrait" => 'hide',
                            ]
                        ]
                    ], 'PATCH');

                    return response()->json([
                        'upload' => [
                            'id'       => $uitem->id,
                            'link'     => $body['upload']['upload_link'],
                            'video_id' => $id,
                            'item'     => $video,
                            'params'   => $params
                        ]
                    ], 200);
                }
            }//*/

            return response()->json(['error' => ''], 501);
        } else {
            return response()->json(['error' => 'not have access'], 500);
        }
    }

    public function makeVideo(Request $request)
    {
        $user = $request->user();

        $client = new \GuzzleHttp\Client();
        $cookie = new \GuzzleHttp\Cookie\CookieJar();

        // Authorise
        $response = $client->request('POST', 'https://iplayerhd.com/cms/login', [
            'cookies'     => $cookie,
            'form_params' => [
                'username' => 'adultfitness1@gmail.com',
                'password' => 'adultfitness5675'
            ]
        ]);


        // Upload file from dropbox
        $response = $client->request('POST', 'https://iplayerhd.com/video-processing/fileUpload', [
            'cookies'     => $cookie,
            'form_params' => [
                'name'             => $request->filename,
                'size'             => $request->size,
                'type'             => "binary/octet-stream",
                'totalSize'        => $request->size,
                'cloudService'     => "dropbox",
                'downloadLink'     => str_replace('dl=0', 'dl=1', $request->url),
                'uploadOptions'    => [
                    'optimize' => 1,
                    'high'     => 1,
                    'low'      => 1,
                    'capture'  => 1
                ],
                'postEncodeParams' => [
                    'addToPlaylist'     => [],
                    'addToFolder'       => [],
                    'createNewPlaylist' => 1
                ]
            ]
        ]);//*/

        // https://iplayerhd.com/cms/videos/562339

        if (200 == $response->getStatusCode()) {
            $json = json_decode($response->getBody());
            $fileId = $json->fileId;

            /*$response = $client->request( 'GET', "https://iplayerhd.com/cms/videos?sortBy=createdAt:-1", [
                    'cookies' => $cookie,
                ]);

            echo $response->getBody();
            return;//*/


            $created = Carbon::now();//parse($item['release_time']);

            $new_video = video::create([
                'embed'        => '',//$item['embed']['html'],
                'link'         => '',//$upload->video_id,
                'link_preview' => '', //$item['pictures']['sizes'][3]['link_with_play_button'],
                'likes'        => 0,
                'dislikes'     => 0,
                'shares'       => 0,
                'views'        => 0,
                'comments'     => 0,
                'duration'     => 0,
                'created_at'   => $created,
                'updated_at'   => Carbon::now(),//parse($item['modified_time']),
                'author_id'    => $user->id,
                'payed'        => ($user->role == "admin") ? 1 : 0,
                'iplayerId'    => $fileId,
                'params'       => 2,
            ]);

            $locales = [
                new videos_locale([
                    'locale'       => 'ru',
                    'title'        => 'Untitled ' . $created->format('m/d/Y'),
                    'content'      => '',
                    'meta_desc'    => '',
                    'meta_keyword' => ''
                ]),
                new videos_locale([
                    'locale'       => 'en',
                    'title'        => 'Untitled ' . $created->format('m/d/Y'),
                    'content'      => '',
                    'meta_desc'    => '',
                    'meta_keyword' => ''
                ])
            ];

            $new_video->locales()->saveMany($locales);
            $locale = \App::getLocale();

            $admins = user::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->Notifies()->create([
                    'text'      => "uploaded new video.",
                    'state'     => 0,
                    'route'     => 'profile.videos',
                    'author_id' => $user->id
                ]);
            }

            return response()->json(['video' => $new_video->Show($locale)], 200);
        }

        // Logout
        $response = $client->request('GET', 'https://iplayerhd.com/cms/logout', [
            'cookies' => $cookie,
        ]);
    }
}
