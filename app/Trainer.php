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
    // Relation table USER
    public function user(){
      return $this->hasOne('App\User');
    }
    // Relation table FORMATION
    public function formations(){
      return $this->belongsToMany('App\Formation')->withPivot('answer_trainer', 'answer_admin');
    }
    // Compte le nombre de formation par formateurs
    public function formationsCount(){
        return $this->belongsToMany('App\Formation')
            ->selectRaw('count(formations.id) as aggregate')
            ->groupBy('pivot_trainer_id');
    }

    // Accesseur qui concatène le nom et le prénom du formateur
    public function getFullNameAttribute(){
        return mb_strtoupper($this->last_name) . ' ' . $this->first_name;
    }

}
