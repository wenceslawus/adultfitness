<?php

namespace App\Models;

use App\traits\localized;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class video extends Model
{
  use localized;

  protected $fillable = [
    'embed',
    'link',
    'link_preview',
    'likes',
    'dislikes',
    'shares',
    'views',
    'comments',
    'duration',
    'params',
    'payed',
	'iplayerId',

    'created_at',
    'author_id',
  ];

  protected $localized = [
    'title',
    'content',
    'meta_desc',
    'meta_keyword',
  ];

  public function locales() {
    return $this->hasMany('App\Models\videos_locale');
  }

  public function Commentaries() {
    return $this->hasMany('App\Models\comment', 'rel_id', 'id')
      ->where('type', '1')
      ->where('parent_id', 0)
      ->orderBy('id', 'desc')
      ->with('author');
  }

  public function Votes() {
    return $this->hasMany('App\Models\vote', 'item_id', 'id');
  }

  public function Viewers() {
    return $this->hasMany('App\Models\view');
  }
  public function Author(){
    return $this->belongsTo('App\Models\user', 'author_id', 'id');
  }

  protected function getAuthor() {
    $u = Auth::id();

    if(!$this->Author){
      $this->Author = User::Admin();
    }
    //if($this->author_id == $u || $this->Author->email != config('mail.admin_mail')) {
      if($this->Author){
        return [
          'id' =>$this->Author->id,
          'name' =>$this->Author->name,
          'avatar' => ($this->Author->avatar)?asset($this->Author->avatar):null,
		  //'this' => $this,
        ];
      } else {
        return [
          'avatar' => null
        ];
      }
    /*} else {
      return null;
    }//*/
  }

  public function Show($locale, $debugData = false) {
    if ($locale)
      $data = $this->Translate($locale);
    else
      $data = $this->mapModel();

    if(isset($data["title"])) {
      $title = $data["title"];
    } else {
      $title = 'Uploaded ' . $this->created_at->format('m/d/Y');
    }

    $values = [
      'id' => $this->id,
      'created_at' => $this->created_at->format('m/d/Y'),
      'duration' => $this->duration,
      'views' => $this->views,
      'payed' => $this->payed,
      'link_preview' => ($this->link_preview)?$this->link_preview:asset('img/no_foto.jpg'),
      //'link_preview' => asset('img/no_foto.jpg'),
      'title' => $title,

      'groups' => $this->Groups->map(function($item){
        return [
          'id' => $item->id,
          'weight' => $item->pivot->weight
        ];
      }),
      'author' => $this->getAuthor(),
    ];

    if($debugData) {
      $values['enabled'] = ($this->params & 2) != 2;
    }

    return $values;
  }


  public function Groups () {
    return $this->belongsToMany('App\Models\category', 'video_category')
      ->withPivot('weight');
  }
  public function Linked () {
    return $this->belongsToMany('App\Models\video', 'video_linked', 'video_id', 'linked_id');
  }

  public function GetFull($locale = null, $user_id = null, $access = false) {
    if ($locale)
      $data = $this->Translate($locale);
    else
      $data = $this->mapModel();

    $myVote = $this->Votes()
      ->where('item_type', 1)
      ->where('user_id', $user_id)
      ->first();

    //$iLike = 0; $iDislike = 0;
    if($myVote) {
      if($myVote->state == 0) {
        $data['iLike'] = 1;
      } else {
        $data['iDislike'] = 1;
      }
    }

    $data = array_merge($data, [
      'id' => $this->id,

      'likes' => $this->likes,
      'dislikes' => $this->dislikes,
      'views' => $this->views,
      'payed' => $this->payed,
      'comment_count' => $this->comments,

      'link_preview' => ($this->link_preview)?$this->link_preview:asset('img/no_foto.jpg'),
      'author' => $this->getAuthor(),

      'groups' => $this->Groups->map(function($item){
        return [
          'id' => $item->id,
          'weight' => $item->pivot->weight
        ];
      }),

      'enabled' => ($this->params & 2) != 2,
      'linked' => $this->Linked()
        ->with(['locales' => category::setLocale($locale)])
        ->Get()
        ->map(function($item)use($locale){
          return $item->Show($locale);
        }),

      'created_at' => $this->created_at->format('m/d/Y'),
      //'all' => $this,
      'myVote' => $myVote,
    ]);

    if(!$this->payed || $access) {
	//if($access) {
      $data['link'] = $this->link;
    }

    $data['comments'] = $this->Commentaries
      ->map(function($comment)use($user_id){
        return $comment->Show(3, $user_id);
      });

    return $data;
  }
}
