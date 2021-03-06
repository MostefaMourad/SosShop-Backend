<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('commandes')->default(0);
            $table->integer('annule')->default(0);
            $table->integer('complete')->default(0);
            $table->integer('acheteur_id')->unsigned();
            $table->foreign('acheteur_id')->references('id')->on('acheteurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paniers');
    }
}
