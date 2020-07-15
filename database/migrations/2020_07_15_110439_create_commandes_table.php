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
            $table->float('cout_livraison');
            $table->float('cout_achat');
            $table->float('cout_total');
            $table->boolean('complete')->default(false);
            $table->integer('product_id')->unsigned();
            $table->integer('panier_id')->unsigned();
            $table->foreign('panier_id')->references('id')->on('paniers')->onDelete('cascade');
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
