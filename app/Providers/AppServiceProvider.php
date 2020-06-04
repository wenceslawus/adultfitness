<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Config;
use App;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      /*
        $key_ss = ['site_languages'];
        //GETTING SITE SETTINGS
        $site_settings = DB::table('option')
                           ->whereIn('key', $key_ss)
                           ->get()
                           ->keyBy('key')
                           ->toArray();
        foreach ($site_settings as $kss => $vss)
        {
            if($vss != null)
            {
                $site_settings[$kss] = @unserialize($vss->value) ? unserialize($vss->value) : null;
            }
        }
        extract($site_settings);

        if(!isset($site_languages['locale']))
        {
           $site_languages['locale'] = [];
           $site_languages['title'] = [];
        }
        //main language or not
        $csl = App::getLocale(); // текущий язык сайта (ru, en etc).
        //если второй сегмент url является локалью (en, ru etc) то изменяем язык сайта
        if(in_array($this->app->request->segment(2), $site_languages['locale']))
        {
            $csl = $this->app->request->segment(2);
        }
        Config::set('csl', $csl);//setting current site language;

        if($csl !== null) App::setLocale($csl);

        view()->share([

           'site_languages' => $site_languages,

           'csl' => $csl,
       ]);//*/
    }



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
