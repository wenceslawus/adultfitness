<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use DB;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct ()
    {
        $this->middleware('locale');
    }
      //извлечение данных из таблицы в зависимости от языка сайта
    public function get_table_data($table, $select = array())
    {
      $class_name = 'App\Models\\'.ucfirst($table);// classes manes have capital latter

      $class_name = new $class_name();

      if(config('csl') == App::getLocale())
      {
        $data = $class_name::where($table.'.id','>',0);
      }
      else
      {
        $data = $class_name::leftJoin($table.'_languages', $table.'.id', '=', $table.'_languages.id_'.$table)
                  ->where($table.'_languages.language', config('csl'));
        //if we need just some columns
        if($select != array())
        {
            $select_arr = array();
            $table_cells = DB::getSchemaBuilder()->getColumnListing($table);
            $table_languages_cells = DB::getSchemaBuilder()->getColumnListing($table.'_languages');
            unset($table_languages_cells[0]);//deleting id from languages page to avoid ambiguities

            foreach($select as $s)
            {
                if(in_array($s, $table_cells))
                {
                    if(in_array($s, $table_languages_cells)) $select_arr[] = $table.'_languages.'.$s;

                    else $select_arr[] = $table.'.'.$s;
                }  
                else continue;
            }
            $data = $data->select($select_arr);
        }
        else $data = $data->select($table.'_languages.*', $table.'.*', $table.'.id as id');
        
      }
      return $data;
    }

        public function save_picture($image) 
    {
        $root = $_SERVER['DOCUMENT_ROOT'].'../storage/app/public';
       // dd($root);

        $image_ext = $image->getClientOriginalExtension();

        $uri = '/'.rand(0,100).'/'.rand(0,100).'/'.rand(0,100).'/';

        $name = rand(10000,99999).'.'.$image->getClientOriginalExtension();
//IF FILE IS NOT A PICTURE JUST SAVE IT WITHOUT RESIZING
        if(!in_array(strtolower($image_ext), ['jpeg','png','jpg','gif']))
        {
            $uri = "/files/".$uri; 

            if(!file_exists($root.$uri)) 
            {
                mkdir($root.$uri,0777,true);
            } 
            $image->move($root.$uri,$name);

            return $uri.$name;
        }
        else
        {
        if(!file_exists($root.'/thumbnail/'.$uri)) 
        {
           mkdir($root.'/thumbnail/'.$uri,0777,true);
        } 
        if(!file_exists($root.'/images/'.$uri)) 
        {
           mkdir($root.'/images/'.$uri,0777,true);
        } 
        $img = Image::make($image->getRealPath());

        $img->resize(800, 600, function ($constraint) {
        $constraint->aspectRatio();
    })->save($root.'/thumbnail/'.$uri.$name);

        $image->move($root.'/images/'.$uri,$name);

        return $uri.$name;
        }
    }

    //delete picture by uri
    public function picture_del($uri)
    {
        if($uri != '' && $uri != 'no_image_gif')
        {
            $root = $_SERVER['DOCUMENT_ROOT'].'../storage/app/public';
            
            if(file_exists($root.'/images/'.$uri) and is_file($root.'/images/'.$uri)) unlink($root.'/images/'.$uri);
            
            if(file_exists($root.'/thumbnail/'.$uri) and is_file($root.'/thumbnail/'.$uri)) unlink($root.'/thumbnail/'.$uri);

            if(file_exists($root.'/files/'.$uri) and is_file($root.'/files/'.$uri)) unlink($root.'/files/'.$uri);
        }
        //deleting row in the table by url - bad practice
       // DB::table('pictures')->where('uri', $uri)->delete();
    }
}
