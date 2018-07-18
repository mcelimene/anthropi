<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $guarded = [];

    // Relation table LEVEL
    public function level(){
      return $this->belongsTo('App\Level');
    }
    // Relation table REGION
    public function region(){
      return $this->belongsTo('App\Region');
    }

    public function user(){
      return $this->hasOne('App\User');
    }

    public function formations(){
      return $this->belongsToMany('App\Formation');
    }

}
