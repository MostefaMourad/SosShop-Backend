<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{
    public $timestamps = false;
   
    protected $fillable = [
        'nom','categorie_id'
    ];
}
