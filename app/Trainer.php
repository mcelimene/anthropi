<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainer extends Authenticatable
{
    use Notifiable;

    protected $table = "trainers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // Relation table LEVEL
    public function level(){
      return $this->belongsTo('App\Level');
    }
    // Relation table REGION
    public function region(){
      return $this->belongsTo('App\Region');
    }
    // Relation Table Role
    public function role(){
      return $this->belongsTo('App\Role');
    }
    // Fonction => retourne si la personne est admin ou pas
    public function isAdministrator() {
     return $this->role()->where('name', 'Admin')->exists();
   }

}
