<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('quantite');
            $table->integer('product_id')->unsigned();
            $table->enum('etat',['panier','livraison'])->default('panier');
            $table->string('image');
            $table->integer('panier_id')->unsigned()->nullable();
            $table->foreign('panier_id')->references('id')->on('paniers')->onDelete('cascade');
            $table->integer('livraison_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
