<?php

namespace App\Models;
use App\traits\localized;
use Illuminate\Database\Eloquent\Model;

class page extends Model {
  use localized;

  protected $fillable = [
    'type',
    'position',
    'link',
    'image'
  ];

  protected $localized = [
    'title',
    'content', 
    'meta_desc',
    'meta_keyword'
  ];

  public function locales()
  {
    return $this->hasMany('App\Models\pages_locale');
  }

  public function GetFull($locale = null) {
    if ($locale)
      $data = $this->Translate($locale);
    else
      $data = $this->mapModel();

    $data = array_merge($data, [
      'link' => $this->link,
      'image' => $this->image,
    ]);

    return $data;
  }
}
