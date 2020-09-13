<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    public $timestamps = false;
   
    protected $fillable = [
        'nom','categorie_id','image','nombre_produits'
    ];
}
