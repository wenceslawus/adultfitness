<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class notifyController extends Controller {	
	public function index(Request $request) {
		$notifies = $request
			->user()
			->getNotifies();
		
		return response()->json([
			'notifies' => $notifies
		], 200);
	}

	public function notyStatus(Request $request) {
		$state = $request->get('state');
		if(!$state) $state = 1;

		$notify = $request->user()
			->Notifies()
			->where('id', $request->id)
			->first();

		$notify->state = $notify->state | $state;
		$notify->save();

		return $this->index($request);//response()->json(['state' => $state], 200);
	}

	public function markRead(Request $request) {
		$user = $request
			->user();

		$unread = $user->notifies()
			->where(DB::RAW('state & 1'), '<>', 1)
			->get();

		foreach($unread as $item){
			$item->update(['state' => $item->state | 1]);
		}
		
		$notifies = $user
			->Notifies()
			->where(DB::RAW('state & 2'), '<>', 2)
			->orderBy('id', 'desc')
			->with('source')
			->get();

		return $this->map($notifies);
	}
}
