<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = false;

    public function trainers() {
      return $this->hasMany('App\Trainer');
    }

    public function formations(){
      return $this->belongsTo('App\Formation')->withPivot('number_of_vacancies');
    }
}
