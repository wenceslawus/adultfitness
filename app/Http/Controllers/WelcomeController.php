<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ssr;
use App\Models\video;
use App\Models\page;
use App\Models\category;
use App\Models\blog_item;

class WelcomeController extends Controller
{
  public function test(Request $request){
    dd($request);
  }

	private function clean($text){
		$text = str_replace('http:', 'https:', $text);
		$text = str_replace('development.adultfitness.com', 'adultfitness.com', $text);
		
		return $text;
	}
    public function withVideo($video_id) {
      $data = [];

      $video = video::find($video_id);
      if ($video) {
        $data['video'] = $video->Show('en');
      }

      $ssr = ssr::where('link', "play/$video_id")->first();

      if ($ssr) {
        $data = [
			'ssr' => $this->clean($ssr->content),
			'ssr_header' => $ssr->header,
		];
      }

      return view('welcome', $data);
    }
    
	public function default($url){
	  $link = '/'. $url;

      $ssr = ssr::where('link', $link)->first();
	  
	  if(!$this->check($link)) {
		  
		  if(in_array($url, ['notify'])){
			  return redirect('/login');
		  }
		  
		  if(in_array($url, ['login'])){
			  return response()->view('welcome');
		  }
		  return response()->view('welcome', [], 404);
	  }
	  
      if($ssr) {
        return view('welcome', [
			'ssr' => $this->clean($ssr->content),
			'ssr_header' => $ssr->header,
		]);
      } else {
        return view('welcome');
      }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      return $this->default('');
    }
	public function Welcome($param)
    {
      return $this->default($param);
    }
	
	private function check($link) {
		if($link == '/') return true;
		
		$params = explode('/', $link);
		
		switch($params[1]) {
			case 'play':
				if(isset($params[2])){
					$video = video::find($params[2]);
					return ($video->params & 2) != 2;
				} else {
					return false;
				}
				//dd($params);
				break;
			case 'blog':
				if(isset($params[2])){
					$blog = blog_item::where('visible', 1)
						->where('id', $params[2])
						->first();
					return $blog->visible;
				} else {
					return false;
				}
				
				break;
			case 'group':
				if(isset($params[2])){
					if($params[2] == 0) return true;
					
					$cat = category::find($params[2]);
					return $cat;
				} else {
					return false;
				}
				break;
			/*case 'page':
				//dd($params);
				
				break;*/
			case 'blogs':
			case 'register':
			case 'contact':
			case 'feedback':
			case 'forgot':
			case 'training':
				return true;
			default:
				if(isset($params[1])){
					$page = page::where('link', $params[1])->first();
					return $page;
				} else {
					return false;
				}
				break;
		}
		
		//dd($params);
	}
	
	public function sitemap() {
		$data = [
			'urls' => [],
			'site' => config('app.url'),
		];
		$dts = ssr::all(['link', 'updated_at'])
			->sortBy('link')
			->keyBy('link')
			->filter(function($item){
				return $this->check($item->link);
			})
			->toArray();
		
		
		//dd($dts);
		
		$data['urls'] = $dts;
		
		return view('sitemap', $data);
	}
	
	public function toIndex() {
		return redirect('/');
	}
}
