<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\blog_category;
use App\Models\blog_item;

class categoryController extends Controller
{

    public function index(Request $request){
        $user = Auth::user();
        $role = ($user)?$user->role:null;
        
        if($role != "admin") {
            $categories = blog_category::where('visible', 1)->get();
        } else {
            $categories = blog_category::get();
        }

        $items = blog_item::orderBy('created_at', 'desc')
            ->limit(10);
        
        if($role != "admin") {
            $items->where('visible', 1);
        }
        
        $items = $items->get();

        return response()->json([
            'blog_category' => $categories,
            'popular' => $items,
            'role' => $role,
        ]);
    }

    public function update(Request $request, $id) {
        $all = $request->only(['visible', 'name']);
        
        if($id == 'new') {
            $cat = blog_category::create($all);
        } else {
            $cat = blog_category::findOrFail($id);
            $cat->update($all);
        }
        
        $user = Auth::user();
        $role = ($user)?$user->role:null;
        if($role == "admin") {
            $categories = blog_category::get();
        } else {
            $categories = blog_category::where('visible', 1)->get();
        }

        return response()->json([
            'blog_category' => $categories,
            'role' => $user
        ]);
    }

    public function edit($id) {
        $user = Auth::user();
        $role = ($user)?$user->role:null;
        if($role == 'admin') {
            $cat = blog_category::findOrFail($id);

            return response()->json(['category' => $cat]);
        }
    }

    public function show($id) {
        $cat = blog_category::with('Records')
            ->where('visible', 1)
            ->where('id', $id)
            ->first();            

        return response()->json(['category' => $cat]);
    }
}
