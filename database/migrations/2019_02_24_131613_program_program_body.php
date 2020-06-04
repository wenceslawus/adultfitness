<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramProgramBody extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_program_body', function (Blueprint $table) {
            $table->integer('program_id')->unsigned()->index();
            $table->integer('program_body_id')->unsigned()->index();

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');

            $table->foreign('program_body_id')
                ->references('id')
                ->on('program_bodies')
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
        Schema::dropIfExists('program_program_body');
    }
}
