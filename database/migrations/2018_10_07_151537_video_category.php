<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideoCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_category', function (Blueprint $table) {
            $table->integer('video_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('weught')->unsigned()->index();

            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('video_category');
    }
}
