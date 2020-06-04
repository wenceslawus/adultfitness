<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\page;
use App\Models\ssr;

class pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        return Pages::where('type', $type)
                    ->orderBy('position')
                    ->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validate_lang(Request $request)
    {
        $all = $request->all();

        $validate_array = [
           'title' => 'required|max:255',
           'content' => 'nullable',
           'description' => 'nullable|max:255',
           'preview' => 'nullable|max:255',
           ];
        if(isset($all['languages']))
        {
            $count = count($all['languages']);

            for($i = 0; $i < $count; $i++)
            {
                $validate_array['languages.'.$i.'.language'] = 'required|max:2';
                $validate_array['languages.'.$i.'.title'] = 'required|max:255';
                $validate_array['languages.'.$i.'.content'] = 'nullable';
                $validate_array['languages.'.$i.'.description'] = 'nullable|max:255';
            }
        }
        $request->validate($validate_array);

        return $all;
    }
    public function store(Request $request)
    {
        $all = $this->validate_lang($request);

        if($request->hasFile('preview')) 
        {
            $image = $request->file('preview');

            $all['preview'] = $this->save_picture($image); 
        }
        $page = Pages::create($all);
 
        if(isset($all['languages']))
        {
            $page->languages()->createMany($all['languages']);
        }
        return 201;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($link) {
        $page = page::where('link', $link)->first();
        
        if(!$page) {
            return response()->json([], 404);
        }
        $locale = \App::getLocale();

        return response()->json([
            "page" => $page->GetFull($locale),
        ], 200);//*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $all = $this->validate_lang($request);

        $page = Pages::find($id);
        //saving picture
        if($request->hasFile('preview')) 
        {
            $image = $request->file('preview');

            $all['preview'] = $this->save_picture($image);

            $this->picture_del($page->preview);    
        }
        //Delete picture without adding new one (if checkbox name="datele_picture" on)
        if(isset($all['delete_picture']))
        {
           $this->picture_del($page->preview); 

           $all['preview'] = null;
        }
        $page->update($all);

        if(isset($all['languages']))
        {
            $page->languages()->delete();
            $page->languages()->createMany($all['languages']);
        }
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Pages::find($id); 

        if($page->preview != null)
        {
           $this->picture_del($page->preview);
        }
        $page->delete();

        return  204; 
    }
	
	public function putNSSR(Request $request) {
		$data = $request->data;
		//dd($data);
		
		$ssr = ssr::where('link', $data['link'])->first();
		
		if($ssr) {
			$ssr->update(['content' => $data['content']]);
		}else{
			$ssr = ssr::create($data);
		}//*/
		
		return response()->json(['i' => $ssr], 200);
	}
}
