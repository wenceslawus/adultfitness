<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class reset_password extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
}
