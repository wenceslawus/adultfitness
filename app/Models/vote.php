<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class vote extends Model {
  protected $fillable = [
    'user_id',
    'item_id',
    'item_type',
    'state'
  ];

}
