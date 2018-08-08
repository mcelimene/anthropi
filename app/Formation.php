<?php

namespace App;
use Illuminate\Support\Facades\DB;
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

    // Retourne le nombre de formations par candidat inscrits
    /*public static function formationApplyCountPerTrainer($id){
      return DB::table('formations')
              ->join('formation_trainer', function($join){
                $join->on('formation.id', '=', 'formation_trainer.formation_id')
                      ->where(function($query) use($id){
                        $query->where('formation_trainer.trainer_id', $id);
                      })
                      ->where('formation_trainer.answer_trainer', '=', 'oui')
                      ->where('formation_trainer.answer_admin', '=', true);
              })
              ->where('validation_registrations', '=', true)
              ->count();
    }*/

}
