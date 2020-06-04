<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('trainer_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('follower_count')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folowers');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('follower_count');
        });//*/
    }
}
