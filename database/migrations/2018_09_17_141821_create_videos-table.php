<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('embed', 500);
            $table->string('link', 255);
            $table->string('link_preview', 255);
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('views')->default(0);
            $table->integer('duration')->default(0);
            $table->integer('comments')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
