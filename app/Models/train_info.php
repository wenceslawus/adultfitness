<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class train_info extends Model {
    static $types = ['description', 'specs', 'exp', 'hobby', 'bio'];

    protected $fillable = [
        'user_id',
        'type',
        'info'
    ];

    public $timestamps = false;
}
