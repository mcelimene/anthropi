<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  public $timestamps = false;
  
  public function trainers() {
    return $this->hasMany('App\Trainer');
  }
}
