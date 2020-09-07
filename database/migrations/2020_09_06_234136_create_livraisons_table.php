<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('acheteur_id')->unsigned();
            $table->foreign('acheteur_id')->references('id')->on('acheteurs')->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('numero');
            $table->string('adresse');
            $table->string('region');
            $table->string('ville');
            $table->string('etat'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livraisons');
    }
}
