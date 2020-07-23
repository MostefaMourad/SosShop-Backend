<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    public $timestamps = false;
    public function espace()
    {
        return $this->hasOne('App\EspaceVendeur');
    }
}
