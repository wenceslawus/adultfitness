<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class upload extends Model {
  protected $fillable = [
    'id',
    'video_id',
    'upload_link'
  ];


}
