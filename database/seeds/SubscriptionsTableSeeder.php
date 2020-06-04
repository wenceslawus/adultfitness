<?php

use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subscriptions::truncate();

        $fake = \Faker\Factory::create();

        for ($i=1; $i<5; $i++)
        {
        	\App\Models\Subscriptions::create([
        	    'title' => $fake->sentence,
        	    'description' => $fake->paragraph,
        	    'price' => $fake->randomFloat(3, 0, 1000),
        	    'term' => $fake->randomDigit(7,14),
        	]);
        }
    }
}
