<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;
    public function panier()
    {
        return $this->hasOne('App\Panier');
    }
    public function espace()
    {
        return $this->hasOne('App\EspaceVendeur');
    }
}
