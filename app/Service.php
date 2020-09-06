<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titre','description','partenaire','numero','prix','image',
    ];
    public $timestamps = false;
}
