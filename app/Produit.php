<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $casts = [
        'images' => 'array'
    ];
    public $timestamps = false;
}
