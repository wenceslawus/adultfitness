<?php
namespace App\traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

trait localized
{
    protected $defaultLocale;

    public static function SetLocale($locale){
        return function ($query) use ($locale) {
            $query->where('locale', $locale)
                ->orWhere('locale', config("app.locale"));
        };
    }

    public function Translate($setLocale = null) {
        $locale = ($setLocale)?$setLocale:$this->defaultLocale;
        $class = __CLASS__;
        $link = substr($class, strrpos($class, '\\') + 1) .'_id';

        $translate = DB::table($this->getTable().'_locales')
            ->where('locale', $locale)
            ->where($link, $this->id)
            ->first();

        $fields = [];
        if($translate)
            foreach($this->localized as $field) {
                $fields[$field] = $translate->$field;
            }

        return $fields;
    }

    public function getByLocale($locale) {
        return $this->with(['locale' => get_class($this)::SetLocale($locale)])
            ->get();
    }

    public function mapModel () {
        $result = ['id' => $this->id];
        
        foreach ($this->fillable as $field) {
            $result[$field] = $this->$field;
        }

        // map localized field
        foreach ($this->locales as $locale) {
            $locale_data = ['id' => $locale->id ];

            foreach ($this->localized as $field) {
                $locale_data[$field] = $locale->$field;
            }
            $result['locales'][$locale->locale] = $locale_data;
        }

        return $result;
    }

    public function mapLocales($with = []) {
        $result = $this->mapModel();
        // map child models
        foreach ($with as $model) {
            $model_localized = [];
            foreach ($this->$model as $item) {
                $model_localized[] = $item->mapModel();
            }
            $result[$model] = $model_localized;
        }

        return $result;
    }
}
