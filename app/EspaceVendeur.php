<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspaceVendeur extends Model
{
    public $timestamps = false;
    public function produits()
    {
        return $this->hasMany('App\Produit');
    }
}
