<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    protected $fillable = [
        'user_id',
        'video_id'
    ];

    public function Video () {
        return $this->belongsTo('App\Models\video');
    }
}
