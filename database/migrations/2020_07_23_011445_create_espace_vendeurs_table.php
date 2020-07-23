<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspaceVendeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espace_vendeurs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('produits_vendus')->default(0);
            $table->integer('nombre_produits')->default(0);
            $table->integer('vendeur_id')->unsigned();
            $table->foreign('vendeur_id')->references('id')->on('vendeurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('espace_vendeurs');
    }
}
