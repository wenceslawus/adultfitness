<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Contactus;
use App\Notifications\Feedback;
use App\Models\user;

class emailController extends Controller
{
    public function contactus(Request $request) {
        $admin = user::admin();

        if($admin) {
            $mail = new Contactus([
                'email' => $request->email,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $admin->notify($mail);
        }

        return response()->json([], 200);
    }

    protected $cats = [
        'Suggestion',
        'Something is not quite right',
        'Compliment'
    ];

    public function feedback(Request $request) {
        $this->middleware('auth:api');
        $admin = user::admin();

        if($admin) {
            if(isset($this->cats[$request->feedCategory-1])) {
                $category = $this->cats[$request->feedCategory-1];
            } else {
                $category = 'No category';
            }

            $mail = new Feedback([
                'email' => $request->email,
                'name' => $request->name,

                'rate' => $request->rate,
                'cat' => $category,
                'description' => $request->description,
            ]);

            $admin->notify($mail);
        }

        return response()->json([], 200);
    }    
}
