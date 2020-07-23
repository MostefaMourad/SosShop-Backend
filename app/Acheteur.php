<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acheteur extends Model
{
    public $timestamps = false;
    public function panier()
    {
        return $this->hasOne('App\Panier');
    }
}
