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
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Carbon::setLocale('fr');
      $formations = Formation::orderBy('date_start', 'ASC')->get();
      $today = Carbon::today();
      return view('admin.formations.index', compact('formations', 'today'));
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
              'dateStart' => $formation->date_start,
              'timeStart' => $formation->time_start,
              'dateEnd' => $formation->date_end,
              'timeEnd' => $formation->time_end
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
      return redirect(route('formations.index'));
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
      return view('admin.formations.show', compact('formation'));
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
      return view('admin.formations.edit', compact('formation'));
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
      $formation = Formation::findOrFail($id);
      $formation->update($request->all());
      return redirect(route('admin.formations.index'));
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
      return redirect('formations');
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
