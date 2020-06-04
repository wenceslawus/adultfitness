<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramProgramType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_program_type', function (Blueprint $table) {
            $table->integer('program_id')->unsigned()->index();
            $table->integer('program_type_id')->unsigned()->index();

            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');

            $table->foreign('program_type_id')
                ->references('id')
                ->on('program_types')
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
        Schema::dropIfExists('program_program_type');
    }
}
