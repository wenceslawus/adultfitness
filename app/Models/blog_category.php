<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog_category extends Model
{
    protected $fillable = [
        'name',
        'visible'
    ];

    public $timestamps = false;

    public function Records(){
        return $this->hasMany('App\Models\blog_item');
    }
}
