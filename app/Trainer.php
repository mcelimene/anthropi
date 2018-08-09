<?php

namespace App;
use Illuminate\Support\Facades\DB;
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


    // Retourne toutes les données sur les formateurs qui ont participés aux formations (du plus grand nombre jusqu'au plus petit)
    public static function formationTrainerValidate(){
      return DB::table('trainers')
          ->join('formation_trainer', function($join){
            $join->on('trainers.id', '=', 'formation_trainer.trainer_id')
                 ->where('formation_trainer.answer_admin', '=', true);
          })
          ->join('formations', function($join){
            $join->on('formation_trainer.formation_id', '=', 'formations.id')
                 ->where('formations.validation_registrations', '=', true);
          })
          ->join('levels', 'trainers.level_id', '=', 'levels.id')
          ->select(DB::raw('trainers.id, trainers.first_name, trainers.last_name, levels.name as level, count(trainers.last_name) as trainer_count'))
          ->groupBy('trainers.id')
          ->orderBy('trainer_count', 'DESC')
          ->orderBy('trainers.last_name', 'ASC')
          ->get();
    }


    // Retourne toutes les données sur les formateurs qui ont candidaté mais qui ont été le moins retenu
    public static function formationsTrainerRefused(){
      return DB::table('trainers')
          ->join('formation_trainer', function($join){
            $join->on('trainers.id', '=', 'formation_trainer.trainer_id')
                 ->where('formation_trainer.answer_trainer','=', 'oui')
                 ->where('formation_trainer.answer_admin', '=', false);
          })
          ->join('formations', function($join){
            $join->on('formation_trainer.formation_id', '=', 'formations.id')
                 ->where('formations.validation_registrations', '=', true);
          })
          ->join('levels', 'trainers.level_id', '=', 'levels.id')
          ->select(DB::raw('trainers.id, trainers.first_name, trainers.last_name, levels.name as level, count(trainers.id) as trainer_count'))
          ->groupBy('trainers.id')
          ->orderBy('trainer_count', 'DESC')
          ->orderBy('trainers.last_name', 'ASC')
          ->get();
    }

    // Retourne les données des formateurs qui ont le plus répondu aux mails
    public static function emailsResponse(){
        return DB::table('formation_trainer')
                ->join('trainers', 'formation_trainer.trainer_id', '=', 'trainers.id')
                ->join('levels', 'trainers.level_id', '=', 'levels.id')
                ->select(DB::raw('formation_trainer.trainer_id, trainers.first_name, trainers.last_name, levels.name as level, count(formation_trainer.trainer_id) as trainer_count'))
                ->where('formation_trainer.answer_trainer', '=', 'oui')
                ->orWhere('formation_trainer.answer_trainer', '=', 'non')
                ->groupBy('formation_trainer.trainer_id')
                ->orderBy('trainer_count', 'DESC')
                ->get();
    }

    // Retourne les données des formateurs qui ont répondu le plus favorablement aux mails
    public static function emailsResponseFavorable(){
        return DB::table('formation_trainer')
                ->join('trainers', 'formation_trainer.trainer_id', '=', 'trainers.id')
                ->join('levels', 'trainers.level_id', '=', 'levels.id')
                ->select(DB::raw('formation_trainer.trainer_id, trainers.first_name, trainers.last_name, levels.name as level, count(formation_trainer.trainer_id) as trainer_count'))
                ->where('formation_trainer.answer_trainer', '=', 'oui')
                ->groupBy('formation_trainer.trainer_id')
                ->orderBy('trainer_count', 'DESC')
                ->get();
    }

    // Retourne les données des formateurs qui ont répondu le plus défavorablement aux mails
    public static function emailsResponseUnfavorable(){
        return DB::table('formation_trainer')
                ->join('trainers', 'formation_trainer.trainer_id', '=', 'trainers.id')
                ->join('levels', 'trainers.level_id', '=', 'levels.id')
                ->select(DB::raw('formation_trainer.trainer_id, trainers.first_name, trainers.last_name, levels.name as level, count(formation_trainer.trainer_id) as trainer_count'))
                ->where('formation_trainer.answer_trainer', '=', 'non')
                ->groupBy('formation_trainer.trainer_id')
                ->orderBy('trainer_count', 'DESC')
                ->get();
    }

    // Retourne les données des formateurs qui ont répondu le moins répondu aux mails
    public static function emailsNoResponse(){
        return DB::table('formation_trainer')
                ->join('trainers', 'formation_trainer.trainer_id', '=', 'trainers.id')
                ->join('levels', 'trainers.level_id', '=', 'levels.id')
                ->select(DB::raw('formation_trainer.trainer_id, trainers.first_name, trainers.last_name, levels.name as level, count(formation_trainer.trainer_id) as trainer_count'))
                ->where('formation_trainer.answer_trainer', '=', 'en attente')
                ->groupBy('formation_trainer.trainer_id')
                ->orderBy('trainer_count', 'DESC')
                ->get();
    }

    // Retourne le nombre de formations validé par formateur
    public static function formationsPerTrainer(){
      return DB::table('formation_trainer')
          ->join('formations', function($join){
            $join->on('formation_trainer.formation_id', '=', 'formations.id')
                 ->where('formations.validation_registrations', '=', true);
          })
          ->select(DB::raw('formation_trainer.trainer_id, count(formation_trainer.trainer_id) as nb_formations'))
          ->groupBy('formation_trainer.trainer_id')
          ->get();
    }

    // Retourne le nombre de mails de candidature reçu par candidat
    public static function emailsReceveidPerTrainer(){
      return DB::table('formation_trainer')
          ->select(DB::raw('trainer_id, count(trainer_id) as nb_emails'))
          ->groupBy('trainer_id')
          ->get();
    }

    // Accesseur qui concatène le nom et le prénom du formateur
    public function getFullNameAttribute(){
        return mb_strtoupper($this->last_name) . ' ' . $this->first_name;
    }

}
