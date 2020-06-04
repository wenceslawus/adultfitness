<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'file',
    ];

    public function Types() {
        return $this->belongsToMany('App\Models\program_type');
    }

    public function Bodies() {
        return $this->belongsToMany('App\Models\program_body');
    }

    public function Show($locale) {
        return [
          'id' => $this->id,
          'title' => $this->title,
          'image' => $this->image,
          'file' => asset($this->file),
          'description' => $this->description,
       
          'types' => $this->Types->map(function($item){
            return $item->id;
          }),

          'bodies' => $this->Bodies->map(function($item){
            return $item->id;
          }),
        ];
      }
}
