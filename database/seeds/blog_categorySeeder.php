<?php

use Illuminate\Database\Seeder;
use App\Models\blog_category;

class blog_categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 10; $i++) {
            $category = blog_category::create([
                'name' => "Category ".$i,
                'visible' => 1
            ]);
        }
    }
}
