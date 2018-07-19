<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded = [];

    public function trainers(){
      return $this->belongsToMany('App\Trainer')->withPivot('answer_trainer', 'answer_admin');
    }

    public function levels(){
      return $this->belongsToMany('App\Level')->withPivot('number_of_vacancies');
    }
}
