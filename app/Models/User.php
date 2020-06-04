<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\train_info;
use Carbon\Carbon;

class user extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'wallpaper',
        'email_verified_at',
        'email',
        'role',
        'password',
        'api_token',
        'remember_token',
        'follower_count',
    ];

    protected $dates = ['email_verified_at', 'subscribed_to', 'birthday'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'updated_at',
        'subscribed_to',
        'created_at',
    ];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    public function Favorites()
    {
        return $this->hasMany('App\Models\favorite')->with('video');
    }

    public function Bookmarks()
    {
        return $this->hasMany('App\Models\bookmark')->with('video');
    }

    public function asTrainer($locale, $me = null)
    {
        $user_data = $this->Show($locale);

        $followed = false;

        if ($this->Followers()->where('user_id', $me->id)->first()) {
            $followed = true;
        }

        return [
            'name'      => $this->name,
            'avatar'    => ($this->avatar) ? asset($this->avatar) : null,
            'wallpaper' => ($this->wallpaper) ? asset($this->wallpaper) : null,
            'followers' => $this->follower_count,
            'role'      => $this->role,
            'trainer'   => $user_data['trainer'],
            'videos'    => $this->MyVideos->map(function ($item) use ($locale) {
                return $item->Show($locale);
            }),
            'followed'  => $followed,
        ];
    }

    public function Show($locale)
    {
        $data = [
            'id'         => $this->id,
            'email'      => $this->email,
            'locale'     => $this->locale,
            'name'       => $this->name,
            'role'       => $this->role,
            'avatar'     => ($this->avatar) ? asset($this->avatar) : null,
            'wallpaper'  => ($this->wallpaper) ? asset($this->wallpaper) : null,
            //'id_subscription' => $this->id_subscription,
            //'subscribed_to' => $this->subscribed_to,
            'followers'  => $this->follower_count,
            'subscribed' => $this->Subscribed(),
        ];

        $data['trainer'] = [];
        if ($this->role == 'trainer' || $this->role == 'admin') {
            foreach ($this->Infos as $item) {
                $data['trainer'][train_info::$types[$item->type]] = $item->info;
            };
        }

        return $data;
    }

    public function getNotifies()
    {
        $items = $this->Notifies()->where(DB::RAW('state & 2'), '<>', 2)->orderBy('id', 'desc')->with('source')->get();

        return $items->map(function ($item) {
            if ($item->source) {
                $user = [
                    'avatar' => $item->source->avatar,
                    'name'   => $item->source->name
                ];
            } else {
                $user = [
                    'avatar' => 'https://development.adultfitness.com/storage/5cd1d0478da48.jpg',
                    'name'   => 'AdultFitness'
                ];
            }

            /*if(!$user['avatar']){
                'avatar' = 'https://development.adultfitness.com/storage/5cd1d0478da48.jpg';
            }//*/

            return [
                'id'      => $item->id,
                'param'   => json_decode($item->param),
                'route'   => $item->route,
                'text'    => $item->text,
                'user_id' => $item->user_id,
                'state'   => $item->state,
                'dt'      => $item->created_at->diffForHumans(Carbon::now()),//'m/d/y'),
                'source'  => $user,
            ];
        });
    }

    public function Views()
    {
        return $this->hasMany('App\Models\view');
    }

    public function playlists()
    {
        return $this->hasMany('App\Models\playlist');
    }

    public function Upload()
    {
        return $this->hasOne('App\Models\upload', 'user_id', 'id');
    }

    public function Infos()
    {
        return $this->hasMany('App\Models\train_info');
    }

    public function MyVideos()
    {
        return $this->hasMany('App\Models\video', 'author_id', 'id')->where(DB::RAW('params & 2'), '<>', 2);
    }

    public function Notifies()
    {
        return $this->hasMany('App\Models\notify');
    }

    public function Followers()
    {
        return $this->belongsToMany('App\Models\user', 'followers', 'trainer_id', 'user_id');
    }

    public static function admin()
    {
        return user::where('email', config('mail.admin_mail'))->first();
    }

    public function Subscription()
    {
        return $this->hasMany('App\Models\subscription');
    }

    public function Subscribed()
    {
        $ss = $this->Subscription()->orderBy('ends_at', 'desc')->first();

        return ($this->role == "admin" || $ss && ($ss->ends_at > Carbon::now()));
    }
}
