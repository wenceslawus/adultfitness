<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

use App\Models\category;
use App\Models\video;
use Carbon\Carbon;

class indexController extends Controller
{
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $response = [
      'categories' => category::with(['locales' => category::setLocale($locale)])
        ->get()
        ->map(function($video)use($locale) {
          return $video->ShowWithoutVideo($locale);
        }),

      'latest' => video::with(['locales' => category::setLocale($locale)])
        //->where('duration', '>', 0)
        ->where(DB::RAW('params & 2'), '<>', 2)
        ->latest()
        ->limit(5)
        ->get()
        ->map(function($video)use($locale) {
          return $video->Show($locale);
        }),

      'popular' => video::orderBy('views', 'DESC')
        ->with(['locales' => category::setLocale($locale)])
        //->where('duration', '>', 0)
        ->where(DB::RAW('params & 2'), '<>', 2)
        ->limit(15)
        ->get()
        ->map(function($video)use($locale) {
          return $video->Show($locale);
        }),
    ];

    return response($response, 200);
  }
}
