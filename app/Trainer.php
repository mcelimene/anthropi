<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
  protected $guarded = [];

  public function level(){
    return $this->belongsTo('App\Level');
  }

  public function region(){
    return $this->belongsTo('App\Region');
  }

}
