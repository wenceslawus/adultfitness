<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\playlist;
use Carbon\Carbon;
use App;

class playlistController extends Controller {
  public function index(Request $request) {
    $user = $request->user();

    $playlist = $user->playlists()
      ->with('Videos')
      ->get();

    return response()->json([
      'playlists' => $playlist->map(function($item){
        return $item->Show('ru');
      })
    ], 200);
  }

  public function store(Request $request) {
    $request->validate([
      'name' => 'required|max:150',
    ]);

    $user = $request->user();
    $locale = App::getLocale();
    $playlist = $user->playlists()->create([
      'default' => 0,
      'name' => $request->get('name')
    ]);

    return response()->json(['playlist' => $playlist->Show($locale)], 200);
  }

  public function update(Request $request) {
    $request->validate([
      'name' => 'required|max:150',
      'id' => 'required',
    ]);

    $user = $request->user();
    $locale = App::getLocale();
    $playlist = $user->playlists()
      ->where('id', $request->id)
      ->first();
    $playlist->update(['name' => $request->name]);

    return response()->json(['playlist' => $playlist->Show($locale)], 200);
  }

  public function delete($id) {
    playlist::destroy($id);
    return response()->json(['status' => 'done'], 200);
  }

  private function connection(Request $request, $attach = true) {
    $request->validate([
      'video_id' => 'required',
      'playlist_id' => 'required',
    ]);

    $user = $request->user();
    $list_id = $request->get('playlist_id');
    $locale = App::getLocale();

    if($list_id == -1) {
      $playlist = $user
        ->playlists()
        ->where('default', 1)
        ->first();

      if(!$playlist) {
        $playlist = $user
        ->playlists()
        ->create([
          'name' => 'Default',
          'default' => 1
        ]);
      }
    } else {
      $playlist = $request->user()
        ->playlists()
        ->where('id', $request->playlist_id)
        ->first();
    }

    $playlist->Videos()->detach($request->video_id);

    if($attach) {
      $playlist->Videos()->attach($request->video_id, ['created_at' => Carbon::now()]);
    }else{

    }

    return response()->json(['playlist' => $playlist->Show($locale)], 200);
  }

  public function attach(Request $request) {
    return $this->connection($request);
  }

  public function detach(Request $request) {
    return $this->connection($request, false);
  }
}
