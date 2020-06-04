<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Models\video;
use App\Models\comment;
use App\Models\vote;

use Illuminate\Support\Facades\Auth;

class voteController extends Controller
{
    public function vote (Request $request) {
        $locale = App::getLocale();
        $item_type = 1;
        $choise = ($request->type == "like")? 0: 1;
        $user = Auth::user();
        $route = 'play';
        $param = json_encode(['id' => $request->id]);

        if ($request->item == 'vi') {
            $item = video::findOrFail($request->id);
            $_resource = 'video';
        } elseif ($request->item == 'blog') {
            $item_type = 2;
            $route = 'blog';
            $item = comment::findOrFail($request->id);
            $_resource = 'comment';
            $param = json_encode(['id' => $item->rel_id]);
        } elseif ($request->item == 'video') {
            $item_type = 3;
            $item = comment::findOrFail($request->id);
            $_resource = 'comment';
            $param = json_encode(['id' => $item->rel_id]);
        }  else {
            return response()->json(['errors' => 'error request'], 401);
        }

        $vote = $item->Votes()
            ->where('item_type', $item_type)
            ->where('user_id', $user->id)
            ->first();

        if (!$vote) {
            $item->Votes()->create([
                'item_id' => $item->id,
                'item_type' => $item_type,
                'user_id' => $user->id,
                'state' => $choise
            ]);
            if($item->Author) {
                $item->Author->Notifies()->create([
                    'text' => $request->type."d your $_resource.",
                    'state' => 0,
                    'route' => $route,
                    'param' => $param,
                    'author_id' => $user->id,
                ]);
            }
        } else {
            if ($vote->state == $choise) {
                $vote->delete();
            } else {
                $vote->update([
                    'state' => $choise
                ]);

                if($item->Author){
                    $item->Author->Notifies()->create([
                        'text' => $request->type."d your $_resource.",
                        'state' => 0,
                        'route' => $route,
                        'param' => $param,
                        'author_id' => $user->id,
                    ]);
                }
            }
        }//*/

        // update count
        $likes = $item->Votes()
            ->where('item_type', $item_type)
            ->where('state', 0)
            ->count();

        $dislikes = $item->Votes()
            ->where('item_type', $item_type)
            ->where('state', 1)
            ->count();

        if($item_type == 1) {
            $item->update([
                'likes' => $likes,
                'dislikes' => $dislikes
            ]);

            return response()->json([
                'item' => $item->GetFull($locale, $user->id, $user->Subscribed())
            ], 200);
        } else {
            $item->update([
                'like' => $likes,
                'dislike' => $dislikes
            ]);

            return response()->json([
                'item' => $item->Show($item_type, $user->id)
            ], 200);
        }
    }
}
