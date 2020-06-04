<?php

use Illuminate\Database\Seeder;
use App\Models\category;
use App\Models\categories_locale;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            'Gluteus',
            'Quadriceps',
            'Pectoralis',
            'Hamstrings',
            'Gastrocnimeus',
            'Latissimus dorci',
            'Forearm',
            'Abs',
            'Trapezius',
            'Deltoids',
            'Low back',
            'Biceps',
            'Forearm',
            'Triceps',
        ];

        foreach ($cats as $key => $cat) {
            $category = category::create([
                'position' => $key,
                'slug' => '',
            ]);

            foreach(['en', 'ru'] as $locale) {
                $category->locales()->save(new categories_locale([
                    'locale' => $locale,
                    'title' => $cat,
                    'description' => '',
                    'meta_desc' => '',
                    'meta_keyword' => '',
                ]));
            }
        }
        
    }
}
