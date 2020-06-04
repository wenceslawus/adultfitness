<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'message',
        'user_id',
        'parent_id',
        'created_at',

        'type', // blog|video|page
        'rel_id', // id of relative record
        'like',
        'dislike'
    ];

    protected $dates = ['created_at'];
    public $timestamps = false;

    public function Childs()
    {
        return $this->hasMany('App\Models\comment', 'parent_id', 'id')->orderBy('id', 'desc');
    }

    public function Votes()
    {
        return $this->hasMany('App\Models\vote', 'item_id', 'id');
    }

    public function Author()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function Show($item_type = null, $user_id = null)
    {
        if ($this->Author) {
            $author = [
                "id"     => $this->Author->id,
                "name"   => $this->Author->name,
                "avatar" => ($this->Author->avatar) ? asset($this->Author->avatar) : '/statics/no-foto.jpg',
            ];
        } else {
            $author = [
                "name"   => 'Guest',
                "avatar" => "/statics/no-foto.jpg"
            ];
        }

        $myVote = $this->Votes()->where('item_type', $item_type)->where('user_id', $user_id)->first();

        $iLike = 0;
        $iDislike = 0;
        if ($myVote) {
            if ($myVote->state == 0) {
                $iLike = 1;
            } else {
                $iDislike = 1;
            }
        }

        return [
            "id"       => $this->id,
            "like"     => $this->like,
            "dislike"  => $this->dislike,
            "message"  => $this->message,
            "childs"   => [],
            "time"     => $this->created_at->format('m/d/Y'),
            "ilike"    => $iLike,
            "idislike" => $iDislike,

            "author" => $author,
        ];
    }
}
