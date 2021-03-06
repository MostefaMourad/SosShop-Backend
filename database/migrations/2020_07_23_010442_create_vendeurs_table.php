<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendeurs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('telephone_sup')->nullable();
            $table->string('adresse');
            $table->date('date_naissance')->nullable();
            $table->string('image_profil')->nullable();
            $table->string('nom_boutique');
            $table->string('description')->nullable();
            $table->boolean('inscription_complete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendeurs');
    }
}
