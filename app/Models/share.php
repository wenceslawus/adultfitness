<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class share extends Model {
  public $timestamps = false;

  protected $fillable = [
    'user_id',
    'video_id',
    'created_id',
  ];

  protected $dates = ['created_at'];

  
}
