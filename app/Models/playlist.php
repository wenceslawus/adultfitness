<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class playlist extends Model {
  protected $fillable = [
    'name',
    'user_id',
    'default'
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
    'default',
    'id',
    'user_id'
  ];

  public function Videos () {
      return $this->belongsToMany('App\Models\video', 'bookmarks')
        ->where(DB::RAW('params & 2'), '<>', 2);
  }

  public function Show($locale){
    return [
      'id' => $this->id,
      'name' => $this->name,
      'default' => $this->default,
      'videos' => $this->Videos->map(function($item)use($locale){
        return $item->Show($locale);
      })
    ];
  }
}
