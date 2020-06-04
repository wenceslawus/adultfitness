<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoLinkedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_linked', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->integer('linked_id')->unsigned()->index();

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
        Schema::dropIfExists('video_linkeds');
    }
}
