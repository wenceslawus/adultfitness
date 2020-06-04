<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;
use App\Models\Subscriptions;
use App\Models\Categories;
use App\Models\Views;
use App\Models\Pages;
use App\User;
use DB;
use Auth;

class SiteController extends Controller
{
    public function index(Request $request)// главная страница
    {
        $response = [];

    	$response['categories'] = Categories::get();// группы мышц

        $response['latest'] = Videos::latest()->limit(3)->get();// последние добавленные видео

        $response['popular'] = Videos::orderBy('likes', 'DESC')->limit(3)->get();//самые залаканые

        return response($response, 200);
    }
    public function blog()// блог
    {
        return Pages::where('type', 'blog')->latest()->paginate(18);
    }
    public function page($id)// и страница и статья
    {
        return Pages::find($id);
    }
    public function video($id)
    {
    	$video = Videos::find($id);

        $user_id = Auth::id();

    	$if_viewed = DB::table('views')->where('id_users', $user_id)
    	                               ->where('id_videos', $id)
    	                               ->doesntExist();
    	if($if_viewed)
    	{
    		Views::create(['id_users' => $user_id, 'id_videos' => $id]);

    		$video->increment('views');
    	}
    	return $video;
    }
    public function counter($column, $id, Request $request)
    {
    	$video = Videos::find($id);
    	$class_name = 'App\Models\\'.ucfirst($column);

    	$class = new $class_name;

    	if($column == 'likes' || $column == 'dislikes')
    	{
    		$if_like = DB::table('likes')
    		             ->where('id_users', $request->user->id)
    	                 ->where('id_videos', $id)
    	                 ->exists();
    	    $if_dislike = DB::table('dislikes')
    		             ->where('id_users', $request->user->id)
    	                 ->where('id_videos', $id)
    	                 ->exists();
    	                // dd($if_dislike);
    	    if($if_like === false && $if_dislike === false)
    	    {

    	    	$class::create(['id_users' => $request->user->id, 'id_videos' => $id]);

    		    $video->increment($column);
    	    }
    	    //dd($request->user->id);
    	    if(($if_like === true && $column == 'likes') || ($if_dislike === true && $column == 'dislikes'))
    	    {
    	    	$class::where('id_users', $request->user->id)
                      ->where('id_videos', $id)
                      ->delete();
                $video->decrement($column);
    	    }
    	}
    	else
    	{
    		$if_already = $class::where('id_users', $request->user->id)
    	                ->where('id_videos', $id)
    	                ->doesntExist();
    	    if($if_already)
    	    {
    		    $class::create(['id_users' => $request->user->id, 'id_videos' => $id]);

    		    $video->increment($column);
    	    }
    	}
    	return response([$column => $video->{$column}]);
    }
}
