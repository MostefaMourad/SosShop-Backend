<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicite extends Model
{
    protected $fillable = [
        'titre','type','image',
    ];
    public $timestamps = false;
}
