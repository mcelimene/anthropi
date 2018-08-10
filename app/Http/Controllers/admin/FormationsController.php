<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Formation;
use App\Trainer;
use App\Level;
use App\Mail\RegistrationsFormation;
use App\Http\Requests\EditFormationRequest;
use Illuminate\Support\Facades\Mail;


class FormationsController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
      $this->middleware('auth');
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  { // On récupère la date du jour
    Carbon::setLocale('fr');
    $today = Carbon::today();
    // On récupère toutes les formations
    $formations = Formation::orderBy('date_start', 'DESC')->paginate(10);
    // On récupère les formations à venir
    $upcoming_formations = Formation::where('date_start', '>', $today)->where('validation_registrations', true)->paginate(10);
    // On récupère les formations non communiqué aux formateurs
    $no_view_formations = Formation::where('send_email', false)->get();
    return view('admin.formations.index', compact('formations', 'today', 'upcoming_formations', 'no_view_formations'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $levels = Level::get();
    return view('admin.formations.create', compact('levels'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(EditFormationRequest $request)
  {
    $levels = Level::get();

    // On enregistre la formation dans la base de données
    $formation = Formation::create($request->only('name', 'place', 'date_start', 'date_end', 'time_start', 'time_end', 'educational_objective', 'send_email'));
    if($formation->send_email == true){
      foreach ($levels as $level) {
        if($request->input($level->id)){
          // On enregistre les niveaux correspondant à la formation ainsi que le nombre de formateurs pour chaque
          $formation->levels()->attach($level->id, ['number_of_vacancies' => $request->input($level->id)]);
          $trainers = Trainer::where('level_id', $level->id)->get();
          // Données à envoyer aux formateurs
          $data = [
            'date_start' => $formation->date_start,
            'date_end' => $formation->date_end
          ];
          foreach ($trainers as $trainer) {
            // On enregistre les formateurs qui peuvent s'inscrire à la formation dans la base de données
            $formation->trainers()->attach($trainer->id);

            $data['nameTrainer'] = $trainer->first_name;
            // On envoie un mail pour chaque formateur appartenant aux niveau correspondant
            Mail::to($trainer->user->email)
            ->send(new RegistrationsFormation($data));
          }
        }
      }

      return redirect()->route('formations.index')
      ->with('success', 'Un email a été envoyé aux formateurs concernés');
    }
    return redirect()->route('formations.index')
    ->with('success', 'La formation a été créée');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $formation = Formation::findOrFail($id);
    $levels = Level::get();
    return view('admin.formations.show', compact('formation', 'levels'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $formation = Formation::findOrFail($id);
    $levels = Level::get();
    return view('admin.formations.edit', compact('formation', 'levels'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(EditFormationRequest $request, $id)
  {
    $levels = Level::get();
    $formation = Formation::findOrFail($id);
    $formation->update($request->only('name', 'place', 'date_start', 'date_end', 'time_start', 'time_end', 'educational_objective', 'send_email'));
    if($formation->send_email == true){
      foreach ($levels as $level) {
        if($request->input($level->id)){
          // On enregistre les niveaux correspondant à la formation ainsi que le nombre de formateurs pour chaque
          $formation->levels()->attach($level->id, ['number_of_vacancies' => $request->input($level->id)]);
          $trainers = Trainer::where('level_id', $level->id)->get();
          // Données à envoyer aux formateurs
          $data = [
            'date_start' => $formation->date_start,
            'date_end' => $formation->date_end
          ];
          foreach ($trainers as $trainer) {
            // On enregistre les formateurs qui peuvent s'inscrire à la formation dans la base de données
            $formation->trainers()->attach($trainer->id);

            $data['nameTrainer'] = $trainer->first_name;
            // On envoie un mail pour chaque formateur appartenant aux niveau correspondant
            Mail::to($trainer->user->email)
            ->send(new RegistrationsFormation($data));
          }
        }
      }
    }
    return redirect()->route('formations.index')
    ->with('success', 'La formation a été modifié');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $formation = Formation::findOrFail($id);
    $formation->delete();
    return redirect()->route('formations.index')
    ->with('danger', 'La formation a été supprimé');
  }

  private function sendEmails($trainers, $formation){
    $data = array(
      'name' => $formation->name,
      'place' => $formation->place,
      'date_start' => $formation->date_start,
      'time_start' => $formation->time_start,
      'date_end' => $formation->date_end,
      'time_end' => $formation->time_end
    );
    foreach ($trainers as $trainer) {
      $data['email'] = $trainer->user->email;
      $data['first_name'] = $trainer->first_name;

      Mail::send('emails.availabilityRequest', $data, function($message) use ($data) {
        $message->to($data['email'])->subject('Demande de disponilité - AnthoPi');
      });
    }


  }
}
