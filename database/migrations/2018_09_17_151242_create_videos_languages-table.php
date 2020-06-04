<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_locales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('video_id')->index();
            $table->string('locale');
            $table->string('title');
            $table->text('content');
            $table->string('meta_desc');
            $table->string('meta_keyword');

            $table->foreign('video_id')
              ->references('id')
              ->on('videos')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_locales');
    }
}
