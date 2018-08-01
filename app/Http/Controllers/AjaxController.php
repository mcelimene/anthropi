<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trainer;
use App\Formation;

class AjaxController extends Controller
{
    public function ajaxTrainingFollowUp(Request $request){
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

          return response()->json(['formation' => $formation_id, 'trainer' => $trainer_id]);
        }
      }
    }

}
