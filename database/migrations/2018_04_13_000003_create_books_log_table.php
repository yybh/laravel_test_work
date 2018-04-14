<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id');
            $table->string('title');
            $table->string('user_name');
            $table->string('user_age');
            $table->string('author');
            $table->string('isbn');
            $table->string('location');
            $table->tinyInteger('is_back');
            $table->integer('user_id');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_log');
    }
}
