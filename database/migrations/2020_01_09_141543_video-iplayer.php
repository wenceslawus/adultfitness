<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideoIplayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up() {
        Schema::table('videos', function(Blueprint $table){
            $table->Integer('iplayerId')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('videos', function(Blueprint $table){
			$table->dropColumn('iplayerId');
		});
    }
}
