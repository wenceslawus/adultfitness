<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Http\Middleware\ifPaid;

use App\Models\categories_locale;
use App\Models\video;
use App;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'ifAdmin'])
            ->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category::orderBy('position')
            ->with(['locales' => category::setLocale('ru')])
            ->get();

        return response()->json([]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $locale = App::getLocale();

        if($id == 'recent' || $id == 'popular') {
            $videos = video::with(['locales' => category::setLocale($locale)])
                ->where(DB::RAW('params & 2'), '<>', 2)
                ->orderBy(
                    ($id=='recent')?'created_at':'views',
                    'DESC'
                )
                ->get();

            $data = $videos->map(function($item)use($locale){
                return $item->Show($locale);
              });

            return response()->json([
                'category' => [
                    'title' => ($id == 'recent')?'RECENTLY ADDED':'MOST POPULAR',
                    'category' => $id,
                    'videos' => $data
                ]
            ], 200);
        }

		$field = (is_numeric($id))?'id':'slug';
		
        $category = category::with('videos')
            ->where($field, $id)
            ->first();

        if ($category)
        {
            //$mapped = $category->mapLocales(['videos']);
            //$mapped['videos'] = $category->videos;

            //$category->Translate($locale);

            return response()->json([
                "category" => $category->Show($locale),
            ], 200);
        }
        else
        {
            return response()->json(["errors" => ["category not found"]], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validate_lang(Request $request) {
        $all = $request->all();

        $validate_array = [
           'title' => 'required|max:255',
           'content' => 'nullable',
           ];
        if(isset($all['languages']))
        {
            $count = count($all['languages']);

            for($i = 0; $i < $count; $i++)
            {
                $validate_array['languages.'.$i.'.language'] = 'required|max:2';
                $validate_array['languages.'.$i.'.title'] = 'required|max:255';
                $validate_array['languages.'.$i.'.content'] = 'nullable';
            }
        }
        $request->validate($validate_array);

        return $all;
    }

    // create new category
    public function store(Request $request) {
        //$all = $this->validate_lang($request);

        $category = Categories::create($all);

        if(isset($all['languages']))
        {
            $category->languages()->createMany($all['languages']);
        }
        return 201;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::with('locales')
            ->with('videos')
            ->where('id', $id)
            ->first();

        if ($category)
        {
            $mapped = $category
                ->mapLocales(['videos']);

           //$mapped['videos'] = $category->videos;

            return response()->json([
                "category" => $mapped,
            ], 200);
        }
        else
        {
            return response()->json(["errors" => ["category not found"]], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = category::findOrFail($id);
        $category->update($request->all());

        $locales = [];
        foreach ($request->locales as $index => $locale ) {
            $id = $locale['id'];
            $item = categories_locale::find($id);
            if ($item) {
                $item->update($locale);
                $locales[] = $item;
            }
            else
            {
                $locales[] = new categories_locale([
                    $locale
                ]);
            }
        }
        $category->locales()->saveMany($locales);

        return response()->json([$locales], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = category::findOrFail($id);

        $locales = $category->locales;
        foreach ($locales as $locale) {
            $locale->delete();
        }

        $category->delete();

        return 204;
    }
}
