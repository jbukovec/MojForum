<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teme', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naslov_teme');
            $table->text('opis_teme');
            $table->unsignedInteger('kategorija_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('kategorija_id')->references('id')->on('kategorije')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teme');
    }
}
