<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VoteModification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function(Blueprint $table){
            $table->dropForeign('votes_video_id_foreign');
            $table->dropColumn('video_id');

            $table->integer('item_id')->unsigned()->index();
            $table->integer('item_type')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes', function(Blueprint $table){
            $table->dropColumn(['item_id', 'item_type']);

            $table->integer('video_id')->unsigned()->index();
            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
        });
    }
}
