<?php

namespace App\Http\Controllers;

use App\Models\blog_item;
use App\Models\video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\comment;

use Carbon\Carbon;

class commentaryController extends Controller
{
    public function childs(Request $request, $parent_id)
    {
        $user = $request->user();

        $comment = comment::where('id', $parent_id)->first();
        if (!$comment) {
            return response()->json(['errors' => 'comment not fount'], 404);
        }

        $user = Auth::user();

        if ($user || $comment->type != 2) {
            return response()->json([
                "childs" => $comment->Childs->map(function ($comment) use ($user) {
                    return $comment->Show(3, $user->id);
                })
            ]);
        } else {
            return response()->json(['errors' => 'no access'], 403);
        }
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $types = [
            'blog'  => 2,
            'video' => 1,

        ];
        $item_type = (isset($request->item_type)) ? $request->item_type : '';
        $item_type = (isset($types[$item_type])) ? $types[$item_type] : null;
        $parent_id = (isset($request->parent_id)) ? $request->parent_id : 0;

        if (!$item_type) {
            return response()->json(['errors' => 'error_request'], 500);
        }

        $comment = comment::create([
            'message'    => $request->message,
            'rel_id'     => $request->item_id,
            'type'       => $item_type,
            'user_id'    => $user_id,
            'like'       => 0,
            'dislike'    => 0,
            'parent_id'  => $parent_id,
            'created_at' => Carbon::now(),
        ]);

        if ($parent_id) {
            $parent = comment::find($parent_id);
            if ($parent && $parent->Author) {
                $parent->Author->Notifies()->create([
                    'text'      => "left a response to your comment",
                    'state'     => 0,
                    'route'     => ($item_type == 2) ? 'blog' : 'play',
                    'param'     => $request->item_id,
                    'author_id' => $user_id
                ]);
            }
        } else {
            /*$comment->Author->Notifies()->create([
              'text' => "left a response to your comment",
              'state' => 0,
              'route' => ($item_type == 2)?'blog':'play',
              'param' => $request->item_id
            ]);*/
        }

        if ($item_type == 2) {
            dd('post');
            $post = blog_item::find($request->item_id);
            $author = $post->user;
            if ($author && $author->id != $user_id) {
                $author->Notifies()->create([
                    'text'      => 'left a new comment.',
                    'state'     => 0,
                    'route'     => 'blog',
                    'param'     => json_encode(['id' => $request->item_id]),
                    'author_id' => $user_id
                ]);
            }
        } else {
            $video = video::find($request->item_id);
            $author = $video->Author;
            if ($author && $author->id != $user_id) {
                $author->Notifies()->create([
                    'text'      => 'left a new comment.',
                    'state'     => 0,
                    'route'     => 'play',
                    'param'     => json_encode(['id' => $request->item_id]),
                    'author_id' => $user_id
                ]);
            }
        }

        return response()->json([
            'comment' => $comment->Show()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $comment = comment::findOrFail($id);

        if ($comment->author->id != Auth::id()) {
            return response()->json(['errors' => 'no access'], 403);
        }

        $comment->update([
            'message' => $request->message
        ]);

        return response()->json([
            'item' => $comment->Show()
        ], 200);
    }

    public function destroy($id)
    {
        $comment = comment::findOrFail($id);

        foreach ($comment->Childs as $child) {
            $child->delete();
        }
        $comment->delete();

        if ($comment->author->id != Auth::id()) {
            return response()->json(['errors' => 'no access'], 401);
        }

        return response()->json([//'errors' => 'on development'
        ], 200);
    }


}
