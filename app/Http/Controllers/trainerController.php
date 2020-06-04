<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\follower;

class trainerController extends Controller {
	public function Show($id, Request $request) {
		$user = user::where('id', $id)
			//->where('role', 'trainer')
			//->orWhere('role', 'admin')
			->first();

		if(!$user){
			return response()->json([], 404);
		} else {
			$locale = \App::getLocale();
			return response()->json([
				'trainer' => $user->asTrainer($locale, $request->user()),
			], 200);
		}
	}

	public function follow($trainer_id, Request $request) {
		$trainer = user::findOrFail($trainer_id);
		$user = $request->user();

		if(false && $user->id == $trainer->id) {
			return response()->json(['error' => 'Error following'], 500);
		} else {
			$follower = $trainer->followers()->where('user_id', $user->id)
				->first();

			if($request->state == 'unfollow') {
				$trainer->followers()->detach($user->id);
				$trainer->Notifies()->create([
					'text' => "stopped following you.",
					'state' => 0,
					'author_id' => $user->id,
				]);
			} else {
				if(!$follower) {
					$trainer->Followers()->attach($user->id);
					$trainer->Notifies()->create([
						'text' => "started following you.",
						'state' => 0,
						'author_id' => $user->id,
					]);
				}
			}

			$trainer->update(['follower_count' => $trainer->followers->count()]);
		}

		$locale = \App::getLocale();

		return response()->json([
			'trainer' => $trainer->asTrainer($locale, $user)
		], 200);
	}
}
