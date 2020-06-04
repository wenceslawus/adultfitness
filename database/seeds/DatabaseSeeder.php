<?php

use Illuminate\Database\Seeder;
use App\Models\user;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        factory(user::class, 2)
            ->create()
            ->each(function($u) {
                //$u->issues()->save(factory(App\Issues::class)->make());
            });
    }
}
