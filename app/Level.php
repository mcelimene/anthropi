<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = false;
    
    public function trainers() {
      return $this->hasMany('App\Trainer');
    }
}
