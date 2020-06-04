<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    protected $fillable = [
        'user_id',
        'video_id',
        'play_at',
    ];

    public function Video () {
        return $this->belongsTo('App\Models\video');
    }

    public $timestamps = false;

    protected $dates = ['play_at'];
}
