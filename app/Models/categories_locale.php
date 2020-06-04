<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories_locale extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'title',
		'header',
        'meta_desc',
        'meta_keyword',
		'short_text',
		'long_text',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\category');
    }
}
