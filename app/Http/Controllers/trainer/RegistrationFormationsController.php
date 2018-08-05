<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Trainer;
use App\Formation;

class RegistrationFormationsController extends Controller
{



    public function index(){
      $today = Carbon::today();
      // On récupère l'ID de l'utilisateur
      $user_id = Auth::user()->trainer_id;
      /// On récupère les formations qui lui sont proposés et auxquels il n'a pas répondu
      $formations_id = DB::table('formation_trainer')
          ->where('trainer_id', $user_id)
          ->where('answer_trainer', 'en attente')
          ->get();

      $data = [];
      foreach ($formations_id as $formation_id) {
        array_push($data, $formation_id->formation_id);
      }

      $formations = Formation::whereIn('id', $data)->get();
      return view('trainer.registrationFormations.index', compact('formations', 'today'));
    }

    public function store(Request $request, $id){
      $user_id = Auth::user()->trainer_id;

      if($request->choice == 'oui'){
        $formation = DB::table('formation_trainer')
            ->where('formation_id', $id)
            ->where('trainer_id', $user_id)
            ->update(['answer_trainer' => 'oui']);
      } else {
        $formation = DB::table('formation_trainer')
            ->where('formation_id', $id)
            ->where('trainer_id', $user_id)
            ->update(['answer_trainer' => 'non']);
      }
      return redirect('registration-formations');

    }
}
