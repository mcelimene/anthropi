<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = false;

    public $fillable = ['name'];

    public function trainers() {
      return $this->hasMany('App\Trainer');
    }

    public function formations(){
      return $this->belongsToMany('App\Formation')->withPivot('number_of_vacancies');
    }
}
