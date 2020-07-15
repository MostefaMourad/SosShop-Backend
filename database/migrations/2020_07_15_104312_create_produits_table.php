<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('titre');
            $table->string('description');
            $table->float('prix');
            $table->float('prix_promotionnel');
            $table->string('categorie');
            $table->string('sous-categorie');
            $table->string('marque');
            $table->integer('quantite');
            $table->string('couleur');
            $table->float('longueur');
            $table->float('largeur');
            $table->float('hauteur');
            $table->float('poids');
            $table->json('images');
            $table->integer('espace_vendeur_id')->unsigned();
            $table->foreign('espace_vendeur_id')->references('id')->on('espace_vendeurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
