<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    public $timestamps = false;
    public function commandes()
    {
        return $this->hasMany('App\Commande');
    }
}
