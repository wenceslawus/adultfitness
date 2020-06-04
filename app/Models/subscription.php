<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at'
    ];

    public $timestamps = false;
}
