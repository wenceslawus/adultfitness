<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notify extends Model {
	protected $fillable = [
		'text',
		'user_id',
		'state',
		'route',
		'param',
		'author_id'
	];

	public function source(){
		return $this->belongsTo('App\Models\user', 'author_id', 'id');
	}
}
