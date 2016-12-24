<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('pages');
            $table->integer('price');
            $table->integer('edit_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('autors');
            $table->foreign('edit_id')->references('id')->on('editorials');
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
        Schema::dropIfExists('editorial');
        Schema::dropIfExists('libros');
    }
}
