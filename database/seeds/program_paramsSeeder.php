<?php

use Illuminate\Database\Seeder;

use App\Models\program_type;
use App\Models\program_body;

class program_paramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach([
            'Most popular', 
            'Recently Added', 
            'Beginner', 
            'Intermediate', 
            'Expert', 
            'Body Weight', 
            'At Home'
        ] as $item) {
            $type = program_type::where('name', $item)->first();

            if(!$type) {
                program_type::create([
                    'name' => $item
                ]);
            }
        }

        foreach([
            'Legs',
            'Abs',
            'Chest & Back',
            'Shoulders, Biceps & Triceps',
            'Full body'
        ] as $type) {
            $body = program_body::where('name', $type)->first();

            if(!$body) {
                program_body::create([
                    'name' => $type
                ]);
            }
        }
    }
}
