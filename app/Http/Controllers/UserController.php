<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App;
use App\Models\user;
use App\Models\reset_password;
use App\Models\train_info;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Notifications\MessageEmail;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->except([
                'restore',
                'forgot'
            ]);
    }

    public function profile() {
        $locale = App::getLocale();

        $user = user::where('id', Auth::user()->id)
            //->with(['Bookmarks', 'Favorites'])
            ->first();

        return [
			'user' => $user->Show($locale),
			'notifies' => $user->getNotifies()
		];
    }

    public function saveMe(Request $request) {
      $user = $request->user();
      $data = $request->trainer;
	  //dd($request->all());
      $user->Infos()->get()->each(function($model){$model->delete();});

      if($data) {
        foreach($data as $key => $info){
          if($info) {
            $type = array_search($key, train_info::$types);
            $user->infos()->create([
              'info' => $info,
              'type' => $type
            ]);
          }
        }
      }
	  
	  $user->update([
		'name' => $request->name,
		'email' => $request->email,
	  ]);

      /*$user->Notifies()->create([
        'text' => "User '{$user->name}' upload new video",
        'state' => 0
      ]);//*/
      return response()->json(['user' => $user->Show(\App::getLocale())], 200);
    }

    public function restore (Request $request) {
        $locale = App::getLocale();
        $token = reset_password::where('token', $request->token)
            ->first();

        if (!$token) {
            return response()->json([
                'error' => 'Token broken'
            ], 404);
        }

        if ($token->updated_at->addMinutes(720)->isPast()) {
            $token->delete();
            return response()->json([
                'error' => 'Token broken2'
            ], 404);
        }

        $user = user::where('email', $token->email)
            ->first();

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'user' => $user->Show($locale),
            'access_token' => $user->api_token
        ], 200);
    }

    public function forgot (Request $request) {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = user::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }

        $passwordReset = reset_password::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
            ]
        );
        $passwordReset->save();
      //dd($passwordReset);

        if ($user && $passwordReset) {
            $mail = new PasswordResetRequest($passwordReset->token);
            $user->notify($mail);
        }//*/

        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ], 200);
    }

    public function userList (Request $request) {
			$user = Auth::user();
			$role = ($user)?$user->role:null;

			if($role == 'admin') {
				$users = user::all();

				return response()->json(['users' => $users], 200);
			} else 
				return response()->json(['error' => 'no permit'], 500);
		}
		
		public function setRole (Request $request) {
			$user = Auth::user();
			$role = ($user)?$user->role:null;

			if($role == 'admin') {
					$client = user::findOrFail($request->id);
					$client->update([
						'role' => $request->role
					]);

					return response()->json([], 200);
			} else 
					return response()->json(['error' => 'no permit'], 500);
    }
    
    public function sendMail(Request $request) {
        $user = Auth::user();
        $role = ($user)?$user->role:null;

        if($role == 'admin') {
            $client = user::findOrFail($request->userId);

            $mail = new MessageEmail($request->message);
            $client->notify($mail);

            return response()->json([], 200);
        } else 
            return response()->json(['error' => 'no permit'], 500);
    }
}