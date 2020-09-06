<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom_complet','email','num_commande','sujet','message',
    ];
    public $timestamps = false;
}
