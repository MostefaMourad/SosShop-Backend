<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Vendeur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $timestamps = false;
    public function espace()
    {
        return $this->hasOne('App\EspaceVendeur');
    }
    /**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
    'nom','prenom','telephone','adresse','date_naissance','email', 'password','image_profil'
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token','inscription_complete'
    ];
}
