<?php

namespace App\Http\Controllers\admin;

use App\Mail\MessageRecovery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\CalendarController;
use App\Mail\ConfirmationParticipation;
use App\Trainer;
use App\Formation;
use App\Level;

class TrainingFollowUpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
      $formations = Formation::where('validation_registrations', false)->where('send_email', true)->get();
      $today = Carbon::today();
      return view('admin.trainingFollowUp.index', compact('formations', 'today'));
    }

    public function validateFormation($id){
      $formation = Formation::findOrFail($id);
      // On calcule le nombre de participants au total
      $nb_of_vacancies = DB::table('formation_level')
          ->where('formation_id', $id)
          ->sum('number_of_vacancies');
      // On calcule le nombre de participants selectionnés
      $nb_accept = DB::table('formation_trainer')
          ->where('formation_id', $id)
          ->where('answer_admin', true)
          ->sum('answer_admin');

      $trainers_accept = DB::table('formation_trainer')
          ->where('formation_id', $id)
          ->where('answer_admin', true)
          ->get();
      // Si le nombre de participants sélectionnés est égal au nombre de participants total alors on peut la valider
      if($nb_of_vacancies == $nb_accept){
        $formation->update(['validation_registrations' => true]);
        // On envoie un mail de confirmation aux formateurs sélectionnés
        foreach ($trainers_accept as $trainer) {
          $trainer = Trainer::findOrFail($trainer->trainer_id);
          $data = array(
            'name_trainer' => $trainer->first_name,
            'place' => $formation->place,
            'date_start' => $formation->date_start,
            'date_end' => $formation->date_end,
            'time_start' => $formation->time_start,
            'time_end' => $formation->time_end,
          );
          Mail::to($trainer->user->email)
              ->send(new ConfirmationParticipation($data));
        }
      }
      // Quand une formation est validé on la synchronise sur le calendrier google CalendarController
      Event::create([
         'name' => $formation->name,
         'startDateTime' => Carbon::parse($formation->date_start . $formation->time_start),
         'endDateTime' => Carbon::parse($formation->date_end . $formation->time_end)
      ]);

      // On redirige vers la page suivi des formations
      return redirect()->route('training-follow-up.index')
                       ->with('success', 'Un email de validation a été envoyé aux formateurs concernés');
    }

    public function sendEmails($id){
      // On récupère la formation avec son ID
      $formation = Formation::findOrFail($id);
      // On stocke les données qu'on veut envoyer à la vue
      $data = [
        'date_start' => $formation->date_start,
        'date_end' => $formation->date_end
      ];
      // On envoie un mail à tous les formateurs qui n'ont pas validé leur inscription sur la formation en cours
      foreach ($formation->trainers as $formation_trainer) {
        if($formation_trainer->pivot->answer_trainer == 'en attente'){
          $trainer = Trainer::findOrFail($formation_trainer->pivot->trainer_id);
          $data['name_trainer'] = $trainer->first_name;
          Mail::to($trainer->user->email)
              ->send(new MessageRecovery($data));
        }
      }
      return redirect()->route('training-follow-up.index')
                       ->with('success', 'Un email de relance a été envoyé aux formateurs non-inscrits');
    }
}
