<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog_item extends Model
{
    protected $fillable = [
        'image',
        'title',
        'user_id',
        'blog_category_id',
        'text',
        'visible'
    ];

    public function Commentaries()
    {
        return $this->hasMany('App\Models\comment', 'rel_id', 'id')
            ->where('type', '2')
            ->where('parent_id', 0)
            ->with('author');
    }

    public function Show()
    {
        return [
            'id'               => $this->id,
            'blog_category_id' => $this->blog_category_id,
            'image'            => $this->image,
            'title'            => $this->title,
            'user_id'          => $this->user_id,
            'text'             => $this->text,
            'visible'          => $this->visible,
            'created_at'       => $this->created_at->format('m/d/Y'),
            'updated_at'       => $this->updated_at->format('m/d/Y'),
        ];
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

}
