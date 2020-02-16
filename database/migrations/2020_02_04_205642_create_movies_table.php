<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('year', 8);
            $table->string('director', 64);
            $table->string('poster');
            $table->boolean('rented')->default(false);
            $table->string('trailer');
            $table->text('synopsis');
            $table->bigInteger('category_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('movies', function($table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
