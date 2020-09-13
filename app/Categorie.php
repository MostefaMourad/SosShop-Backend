<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nom','nombre_produits',
    ];
    public function subcategories()
    {
        return $this->hasMany('App\SubCategorie');
    }
}
