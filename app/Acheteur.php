<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Acheteur extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $timestamps = false;
    public function panier()
    {
        return $this->hasOne('App\Panier');
    }
        /**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
    'nom','prenom','telephone','adresse','wilaya','daira','commune','genre','date_naissance','email', 'password','image_profil'
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token',
    ];
}
