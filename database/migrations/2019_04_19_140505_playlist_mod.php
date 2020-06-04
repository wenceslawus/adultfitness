<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlaylistMod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::table('bookmarks', function(Blueprint $table){
        $table->dropForeign('bookmarks_user_id_foreign');
        $table->dropColumn(['user_id', 'updated_at']);
        $table->integer('playlist_id')
          ->unsigned()
          ->index()
          ->after('id');

        $table->foreign('playlist_id')
            ->references('id')
            ->on('playlists')
            ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::table('bookmarks', function(Blueprint $table){
        $table->dropForeign('bookmarks_playlist_id_foreign');
        $table->dropColumn(['playlist_id']);

        $table->integer('user_id')->unsigned()->index();
        $table->timestamp('updated_at')->nullable();

        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
      });
    }
}
