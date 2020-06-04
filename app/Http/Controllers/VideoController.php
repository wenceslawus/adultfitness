<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\video;
use App\Models\videos_locale;
use App\Models\User;
use App\Models\view;

use Vimeo\Laravel\Facades\Vimeo;
use Carbon\Carbon;
use App;

class VideoController extends Controller
{
    public function __construct()
    {

    }

    private function parsePage($path)
    {
        $result = Vimeo::request($path, [], 'GET');
        /*
        echo "<pre>";
        print_r($result['body']['data'][0]);
        echo "</pre>";
        dd($result);//*/
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

            //dd(['a' => '299968762/56b90e527b']);

            $fields = [
                'embed'        => $item['embed']['html'],
                'link'         => $id,
                'link_preview' => $item['pictures']['sizes'][3]['link_with_play_button'],
                'likes'        => 0,
                'dislikes'     => 0,
                'shares'       => 0,
                'views'        => 0,
                'comments'     => 0,
                'duration'     => $item['duration'],
                'created_at'   => Carbon::parse($item['release_time']),
                'updated_at'   => Carbon::parse($item['modified_time']),
            ];

            $locales = [
                new videos_locale([
                    'locale'       => 'ru',
                    'title'        => $item['name'],
                    'content'      => '' . $item['description'],
                    'meta_desc'    => '',
                    'meta_keyword' => ''
                ]),
                new videos_locale([
                    'locale'       => 'en',
                    'title'        => $item['name'],
                    'content'      => '' . $item['description'],
                    'meta_desc'    => '',
                    'meta_keyword' => ''
                ]),
            ];

            if (!$video_exist) {
                $model = new video($fields);
                $model->save();
                $model->locales()->saveMany($locales);
            } else {
                $video_exist->update($fields);
                //$video_exist->locales()->delete();
                //$video_exist->locales()->saveMany($locales);
            }
        }

        return $vdata['paging']['next'];
    }

    public function sync(Request $request)
    {
        /*$video = Vimeo::request('/videos/282922114', [
          "name" => "Prone Hip Extensions - Single to Double Leg",
          "privacy.embed" => "public"
          //"params" => '{"privacy.embed":"public"}'
        ], 'PATCH');
        dd($video);

        /*
        $video = Vimeo::request('/videos/293134179', [], 'GET');
        $video = Vimeo::request('/videos/293134179', [
          "name" => 'changed',
        ], 'PATCH');/*/

        //$video = Vimeo::request('/videos/'.$request->code, [], 'GET');


        $path = '/me/videos';
        while ($path) {
            $path = $this->parsePage($path);
        }

        return $this->index($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locale = App::getLocale();

        $query = video::where(DB::RAW('params & 2'), '<>', 2)->with('locales');

        $videos = $query->get()->map(function ($video) use ($locale) {
            return $video->Show($locale);
        });

        return response()->json(['videos' => $videos], 200);
    }

    public function indexEdit(Request $request)
    {
        $user = $request->user();

        if ($user->role == 'admin' || $user->role == 'trainer') {
            $locale = App::getLocale();

            $query = video::with('locales');

            if ($user->role == 'trainer') {
                $query->where('author_id', $user->id);
            }

            $videos = $query->get()->map(function ($video) use ($locale) {
                return $video->Show($locale, true);
            });
        } else {
            $videos = [];
        }

        return response()->json(['videos' => $videos], 200);
    }

    public function switch(Request $request)
    {
        $admin = User::admin();
        $locale = App::getLocale();
        $video = video::find($request->id);
        // $link_data = explode('/', $video->link);
        // $vimeo_data = Vimeo::request("/videos/$link_data[0]", [], 'GET');

        /*if (isset($vimeo_data['body'])) {
            $vimeo_data = $vimeo_data['body'];
        } else {
            $vimeo_data = null;
        }*/

        /*if ($vimeo_data && isset($vimeo_data['pictures']) && isset($vimeo_data['pictures']['sizes'])) {
            $size = null;
            if (isset($vimeo_data['pictures']['sizes'][3]))
                $size = $vimeo_data['pictures']['sizes'][3]; elseif (isset($vimeo_data['pictures']['sizes'][2]))
                $size = $vimeo_data['pictures']['sizes'][2];
            elseif (isset($vimeo_data['pictures']['sizes'][1]))
                $size = $vimeo_data['pictures']['sizes'][1];
            elseif (isset($vimeo_data['pictures']['sizes'][0]))
                $size = $vimeo_data['pictures']['sizes'][0];

            if ($size) {
                $video->link_preview = $size['link_with_play_button'];
            }

            $link_data = explode('vimeo.com/', $vimeo_data['link']);
            $video->link = $link_data[1];
            $video->duration = $vimeo_data['duration'];
        }*/

        if ($request->visible && ($video->params & 2) == 2) {
            $video->params -= 2;

            $author = $video->Author;
            foreach ($author->Followers as $follower) {
                $follower->Notifies()->create([
                    'text'      => "uploaded a new video.",
                    'state'     => 0,
                    'route'     => 'play',
                    'param'     => json_encode(['id' => $video->id]),
                    'author_id' => $author->id
                ]);
            }

            $author->Notifies()->create([
                'text'      => "Your video has been approved",
                'state'     => 0,
                'route'     => 'play',
                'param'     => json_encode(['id' => $video->id]),
                'author_id' => $admin->id
            ]);
        } else {
            if (!$request->visible && ($video->params & 2) != 2) {
                $video->params += 2;
            }
        }

        $video->save();

        return response()->json([
            'video' => $video->Show($locale, true)
        ], 200);
    }

    public function store(Request $request)
    {
        $video = Videos::create($all);

        if (isset($all['languages'])) {
            $video->languages()->createMany($all['languages']);
        }
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = video::findOrFail($id);

        if (($video->params & 2) == 2) {
            return response()->json([
                'error' => 'Video not availabled'
            ], 404);
        }

        $user = Auth::user();

        if ($user) {
            $viewed = $user->Views()->where('video_id', $video->id)->first();

            if ($viewed) {
                $viewed->update(['play_at' => Carbon::now()]);
            } else {
                $user->Views()->save(new view([
                    'play_at'  => Carbon::now(),
                    'video_id' => $video->id
                ]));

                $video->update([
                    "views" => $video->Viewers()->count()
                ]);
            }
        }

        $locale = App::getLocale();

        if ($user) {
            $access = $user->Subscribed() || ($user->role == 'trainer' && $video->author_id == $user->id);
            /*dd([
              $user->Subscribed(),
              $access,
              $video->author_id,
              $user->id
            ]);//*/
            $video_data = $video->GetFull($locale, $user->id, $access);
        } else {
            $video_data = $video->GetFull($locale, 0, false);
        }

        return response()->json([
            "video" => $video_data,
        ], 200);
    }

    public function play($id)
    {
        $video = video::findOrFail($id);
        if (($video->params & 2) == 2) {
            return response()->json([
                'error' => 'Video not availabled'
            ], 404);
        }

        return response()->json([
            'link' => $video->link
        ], 200);
    }

    public function addLinked(Request $request)
    {
        $locale = App::getLocale();

        if ($request->id != $request->linked) {
            $video = video::findOrFail($request->id);
            $linked = video::findOrFail($request->linked);

            $res = $video->linked()->where('linked_id', $linked->id)->first();

            if (!$res) {
                $video->linked()->attach($linked->id);
            } else {
                $video->linked()->detach($linked->id);
            }

            return response()->json([
                'linked'    => $linked->Show($locale),
                'connected' => !$res
            ], 200);
        }

        return response()->json([], 200);
    }

    public function addFavorite(Request $request)
    {
        $locale = App::getLocale();
        $user = Auth::user();
        $video = video::findOrFail($request->id);

        $exist = $user->Favorites()->where('video_id', $video->id)->first();

        if (!$exist) {
            $user->Favorites()->create([
                'video_id' => $video->id
            ]);

            return response()->json([
                'video' => $video->Show($locale)
            ], 200);
        }

        return response()->json([], 200);
    }

    public function addBookmark(Request $request)
    {
        $user = Auth::user();
        $video = video::findOrFail($request->id);
        $locale = App::getLocale();

        $exist = $user->Bookmarks()->where('video_id', $video->id)->first();

        if (!$exist) {
            $user->Bookmarks()->create([
                'video_id' => $video->id
            ]);

            return response()->json([
                'video' => $video->Show($locale)
            ], 200);
        }

        return response()->json([], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = video::findOrFail($id);

        return response()->json([
            "video" => $video->GetFull(null, null, true),
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = video::findOrFail($id);
        $user = $request->user();

        if ($user->role != 'admin' && $video->author_id != $user->id) {
            return response(['error' => 'no_permit'], 303);
        }

        $params = [];
        foreach ($request->groups as $group) {
            $params[$group['id']] = ['weight' => $group['weight']];
        }

        $video->Groups()->sync($params);

        if ($user->role == 'admin') {
            $video->update([
                'payed' => ($request->payed) ? 1 : 0,
            ]);
        }

        $video->update([
            'payed'        => ($request->payed) ? 1 : 0,
            'duration'     => $request->duration,
            'link'         => $request->link,
            'link_preview' => $request->link_preview,
        ]);

        $locales = [];
        foreach ($request->locales as $index => $locale) {
            //$id = $locale['id'];
            $item = videos_locale::where('locale', $index)->where('video_id', $video->id)->first();

            if ($item) {
                $item->update($locale);
                $locales[] = $item;
            } else {
                $locale['locale'] = $index;
                $locales[] = new videos_locale($locale);
            }
        }

        $video->locales()->saveMany($locales);

        return response()->json([
            'video' => $video->GetFull(App::getLocale(), null, true)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Videos::find($id);

        // $video->languages()->delete();
        $video->delete();

        return response()->json(null, 204);
    }

    public function attach($id_parent, $id_child)
    {
        $data['id_parent'] = $id_parent;
        $data['id_child'] = $id_child;
        $attachment = Attachment::where('id_parent', $id_parent)->where('id_child', $id_child);

        if ($attachment->doesntExist()) {
            Attachment::create($data);
        } else {
            $attachment->delete();
        }

        return response(null, 200);
    }
}
