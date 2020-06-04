<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\blog_category;
use App\Models\blog_item;

use Carbon\Carbon;

class blogController extends Controller
{
    public function index(Request $request) {
        $items = blog_item::where('visible', 1)
            ->orderBy('created_at', 'desc')
            ->limit(10);

        return response()->json(['blog_records' => $items]);
    }

    private function tryValidate($request) {
        $request->validate([
            'title' => 'required|max:255',
            'blog_category_id' => 'required',
            'text' => 'required'
        ]);
    }

    public function store(Request $request) {
        $this->tryValidate($request);

        $all = $request->only(['image', 'title', 'blog_category_id', 'text', 'visible']);
        $all['user_id'] = Auth::user()->id;
        
        if(!isset($all['image'])) {
            $all['image'] = 'default_image';
        }
        if(!isset($all['visible'])) {
            $all['visible'] = 1;
        }

        $item = blog_item::create($all);

        return response()->json(['record' => $item]);
    }

    public function edit($id) {
        $user = Auth::user();
        $role = ($user)?$user->role:null;
        if($role == 'admin') {
            $cat = blog_item::findOrFail($id);

            return response()->json(['record' => $cat]);
        }
    }
    
    public function update(Request $request, $id) {
        if($id == 'new') {
            return $this->store($request);
        }

        $item = blog_item::findOrFail($id);
        $this->tryValidate($request);

        $all = $request->only(['image', 'title', 'blog_category_id', 'text', 'visible']);
        $item->update($all);

        return response()->json(['record' => $item]);
    }

    public function show($id) {
        $item = blog_item::where('visible', 1)
            ->where('id', $id)
            ->first();

        return response()->json([
            'blog_record' => $item->Show(),
            'comments' => $item->Commentaries
                ->map(function($comment){
                    return $comment->Show();
                })
        ]);
    }

    public function getList(Request $request) {
        $categories = $request->input("categories");
        $times = $request->input("times");

        $query = blog_item::where('visible', 1)
            ->orderBy('created_at', 'desc');

        if($categories && count($categories) > 0) {
            $query->whereIn('blog_category_id', $categories);
        }

        switch($times) {
            case 'year':
                $dt = Carbon::now()->subYears(1);
                $query->where('created_at', '>', $dt);
                break;
            case 'year_lt':
                $dt = Carbon::now()->subMonths(6);
                $query->where('created_at', '>', $dt);
                break;
            case 'year_gt':
                $dt = Carbon::now()->subYears(1);
                $query->where('created_at', '<', $dt);
                break;
        }

        $items = $query->get();

        return response()->json(['blog_records' => $items]);
    }
}
