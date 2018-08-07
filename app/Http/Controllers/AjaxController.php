<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Trainer;
use App\Formation;

class AjaxController extends Controller
{
    public function trainingFollowUp(Request $request){
      //$nb_accept = [];
      // On récupère les données envoyées en ajax
      $data = $request->all();
      // On la coupe en deux pour récupérer l'ID du formateur et l'ID de la formation
      $infos = explode('-', $data['infos']);
      // On récupère les ID
      $trainer_id = (int) filter_var($infos[0], FILTER_SANITIZE_NUMBER_INT);
      $formation_id = (int) filter_var($infos[1], FILTER_SANITIZE_NUMBER_INT);
      // On récupère toutes les données du formateur
      $trainer = Trainer::findOrFail($trainer_id);
      // On récupère toutes les données de la formations
      $formation = Formation::findOrFail($formation_id);
      // On boucle sur la liste des formations auxquelles il est inscrit
      foreach ($trainer->formations as $trainer_formation) {
        // On récupère la formation souhaitée parmi celles où il est inscrit
        if($trainer_formation->id == $formation_id){
          // On change la réponse de l'administrateur par true si c'était false et par false si c'était true
          if($trainer_formation->pivot->answer_admin == false){
            $trainer_formation->pivot->answer_admin = true;
          } else {
            $trainer_formation->pivot->answer_admin = false;
          }
          // On sauvegarde la réponse dans la base de données
          $trainer_formation->pivot->save();

          // On récupère les id des formateurs sélectionnés
          $trainers_accept = DB::table('formation_trainer')
              ->where('formation_id', $formation_id)
              ->where('answer_admin', true)
              ->get();
          $trainers_accept_id = [];
          // On met ces ID dans un tableau
          foreach ($trainers_accept as $trainer) {
            array_push($trainers_accept_id, $trainer->trainer_id);
          }
          // On récupère les formateurs grâce à leur id puis on extrait les différents niveaux
          $trainers = Trainer::whereIn('id', $trainers_accept_id)->get();
          $count_level = [];
          // On compte le nombre de participants par niveau
          foreach ($trainers as $trainer) {
            @$count_level[$trainer->level_id]++;
          }

          return response()->json(['formation' => $formation_id, 'trainer' => $trainer_id, 'levels' => $count_level]);
        }
      }
    }

}
