<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('title');
            $table->integer('user_id')->unsigned()->index();
            //$table->string('name');
            $table->longText('text');
            $table->integer('blog_category_id')->unsigned()->index();
            $table->tinyInteger('visible');
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
        Schema::dropIfExists('blog_items');
    }
}
