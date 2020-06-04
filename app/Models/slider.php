<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    protected $fillable = [
        'id',
        'title',
        'body',
        'image',
        'program',
        'width',
        'height'
    ];
    public $timestamps = false;
}
