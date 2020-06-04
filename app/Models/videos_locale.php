<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class videos_locale extends Model {
  public $timestamps = false;

  protected $fillable = [
    'locale',
    'title',
    'content',
    'meta_desc',
    'meta_keyword'
  ];

  public function locales() {
    return $this->belongsTo('App\Models\videos_locale');
  }

  public function video() {
    return $this->belongsTo('App\Models\video');
  }
}
