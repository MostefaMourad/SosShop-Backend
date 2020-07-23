<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nom',
    ];
    public function subcategories()
    {
        return $this->hasMany('App\SubCategorie');
    }
}
