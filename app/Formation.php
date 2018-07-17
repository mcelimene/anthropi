<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded = [];

    public function trainers(){
      return $this->belongsTo('App\Trainer');
    }
}
