<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('telephone')->nullable();
            $table->string('wilaya')->nullable();
            $table->string('daira')->nullable();
            $table->string('commune')->nullable();
            $table->string('adresse')->nullable();
            $table->boolean('genre')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('type_compte',['acheteur','vendeur']);
            $table->string('image_profil')->nullable();
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
        Schema::dropIfExists('utilisateurs');
    }
}
