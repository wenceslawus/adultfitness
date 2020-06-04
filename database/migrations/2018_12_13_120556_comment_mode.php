<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentMode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('video_id');

            $table->integer('type')->unsigned();
            $table->integer('rel_id')->unsigned();
            $table->integer('like')->unsigned();
            $table->integer('dislike')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('video_id');
            $table->dropColumn([
                'type',
                'rel_id',
                'like',
                'dislike',
            ]);
        });
    }
}
