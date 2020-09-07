<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $fillable = [
        'acheteur_id','nom','prenom','numero','adresse','region','ville','etat'
    ];
    public $timestamps = false;
}
