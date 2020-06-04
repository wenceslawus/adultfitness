<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\traits\localized;

class category extends Model
{
  use localized;

  public $timestamps = false;

  protected $fillable = [
    'position',
    'slug',
  ];

  protected $localized = [
    'title',
	'header',
    'meta_desc',
    'meta_keyword',
	'short_text',
	'long_text',
    'description',
  ];

  public function videos () {
    return $this->belongsToMany('App\Models\video', 'video_category')
      ->with('locales');
  }
  public function locales()
  {
    return $this->hasMany('App\Models\categories_locale');
  }

  public function ShowWithoutVideo($locale) {
    $data = $this->Translate($locale);
    $data['id'] = $this->id;
	$data['slug'] = $this->slug;
    return $data;
  }

  public function Show($locale) {
    $data = $this->Translate($locale);
    
    $videos = $this
      ->videos()
      ->where(DB::RAW('params & 2'), '<>', 2)
      ->with(['locales' => category::setLocale($locale)])
      ->get();

    $data['videos'] = $videos->map(function($item)use($locale){
      return $item->Show($locale);
    });

    return $data;
  }


}
