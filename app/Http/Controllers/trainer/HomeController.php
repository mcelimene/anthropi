<?php

namespace App\Http\Controllers\trainer;

use App\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Formation;

class HomeController extends Controller
{
    public function index(){
      // Date du jour
      // On récupère l'Id de l'utilisateur
      $user_id = Auth::user()->trainer_id;
      $trainer = Trainer::findOrFail($user_id);
      // On compte le nombre de formations qui lui a été proposé
      $nb_offer = $trainer->formations->count();
      $nb_answer = ['non' => 0, 'oui' => 0, 'en_attente' => 0];
      foreach ($trainer->formations as $trainer_formation) {
        if($trainer_formation->pivot->answer_trainer == 'non'){
          $nb_answer['non']++;
        } elseif ($trainer_formation->pivot->answer_trainer == 'oui') {
          $nb_answer['oui']++;
        } else {
          $nb_answer['en_attente']++;
        }
      }
      // On récupère les formations auxquels il participe
      $formations = DB::table('formation_trainer')
          ->where('trainer_id', $user_id)
          ->where('answer_trainer', 'oui')
          ->where('answer_admin', true)
          ->get();

      $data = [];
      foreach ($formations as $formation) {
        array_push($data, $formation->formation_id);
      }

      $formations = Formation::whereIn('id', $data)->where('date_start', '>', Carbon::today())->orderBy('date_start', 'ASC')->get();
      return view('trainer.home.index', compact('trainer', 'nb_offer', 'nb_answer','formations'));
    }
}
