<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotyField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('notifies', function(Blueprint $table){
            $table->string('route')->nullable();
            $table->string('param')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('notifies', function(Blueprint $table){
            $table->dropColumn(['route', 'param']);
        });
    }
}
