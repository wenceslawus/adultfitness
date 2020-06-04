<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\videos_locale;
use Illuminate\Support\Facades\DB;

use App;

class SearchController extends Controller
{
    public function search(Request $request) {
        $locale = App::getLocale();
        $query = $request->input('text');
        
        $videos = videos_locale::select('video_id')
            ->where('title','LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->groupBy('video_id')
            ->with('video')
            ->get()
            ->filter(function($record){
                return ($record->video->params & 2) != 2;
            })
            ->map(function($video)use($locale) {
                return $video->video->Show($locale);
            })->toArray();

        return response()->json([
            'text' => $query,
            'items' => array_values($videos)
        ]);
    }
}
