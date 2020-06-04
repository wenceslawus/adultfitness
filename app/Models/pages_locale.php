<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pages_locale extends Model {
  public $timestamps = false;
  
  protected $fillable = [
    'language',
    'page_id',
    'title',
    'content', 
    'description', 
    'meta_desc',
    'meta_keyword'
  ];

  public function page()
  {
    return $this->belongsTo('App\Models\page');
  }
}
