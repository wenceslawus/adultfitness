<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookmark extends Model
{
    protected $fillable = [
        'playlist_id',
        'video_id',
        'created_at'
    ];
    
    public $timestamps = false;

    public function Video () {
        return $this->belongsTo('App\Models\video');
    }
}
