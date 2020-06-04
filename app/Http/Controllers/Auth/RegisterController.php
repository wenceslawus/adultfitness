<?php

namespace App\Http\Controllers\Auth;

use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use App\Notifications\BecomeTrainer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return user::create([
            'name'           => $data['name'],
            'email'          => $data['email'],
            'password'       => Hash::make($data['password']),
            'remember_token' => isset($data['remember_token']) ? $data['remember_token'] : ''
        ]);
    }

    public function register(Request $request)
    {
        // Here the request is validated. The validator method is located
        // inside the RegisterController, and makes sure the name, email
        // password and password_confirmation fields are required.

        $this->validator($request->all())->validate();

        //$all = $request->all();
        //$all['password'] = Hash::make($all['password']);
        // A Registered event is created and will trigger any relevant
        // observers, such as sending a confirmation email or any
        // code that needs to be run as soon as the user is created.
        event(new Registered($user = $this->create($request->all())));
        //$user = User::create($all);


        // After the user is created, he's logged in.
        $this->guard()->login($user);

        // And finally this is the hook that we want. If there is no
        // registered() method or it returns null, redirect him to
        // some other URL. In our case, we just need to implement
        // that method to return the correct response.
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function become(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6',
            'achievements' => 'required',
            'education'    => 'required',
            'experience'   => 'required',
            'regularly'    => 'required',
            'skill'        => 'required',
        ]);

        $data = $request->all();
        $data['remember_token'] = Str::random(32);

        event(new Registered($user = $this->create($data)));
        $this->guard()->login($user);

        $admin = user::admin();
        $mail = new BecomeTrainer($data);
        $admin->notify($mail);
        $admin->Notifies()->create([
            'text'      => 'wants to learn from you.',
            'state'     => 0,
            'route'     => '',
            'param'     => '',
            'author_id' => $user->id,
        ]);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();
        $locale = \App::getLocale();
        return response()->json([
            'user'         => $user->Show($locale),
            'access_token' => $user->api_token
        ], 201);
    }

    public function activateTrainer($token)
    {
        $user = user::where('remember_token', $token)->first();
        if ($user) {
            $user->update([
                'role'           => 'trainer',
                'remember_token' => null
            ]);
            echo "Done";
        } else {
            echo "User not found";
        }
    }
}
