<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use Egulias\EmailValidator\Validation\RFCValidation;
use App\Level;
use App\Formation;
use App\Region;
use App\Trainer;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditTrainerRequest;
use App\Http\Requests\EditUserRequest;

class TrainersController extends Controller
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
        $trainers = Trainer::with('level', 'region')->orderBy('last_name', 'ASC')->paginate(10);

        return view('admin.trainers.index',compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        return view('admin.trainers.create', compact('regions', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditTrainerRequest $requestTrainer, EditUserRequest $requestUser)
    {
        // Stockage du CV
        if($requestTrainer->cv){
          $cv = $requestTrainer->cv->store('public/datadock/cv');
          $cv = str_replace('public/', '', $cv);
          // Insertion du formateur dans la base de données
          $trainer = Trainer::create(array_merge($requestTrainer->except('email', 'cv'),
              [
                'cv' => $cv
              ]));
        } else {
          // Insertion du formateur dans la base de données
          $trainer = Trainer::create($requestTrainer->except('email'));
        }
        // Création du mot de passe
        $password = $this->getPassword();
        $password_crypt = $this->getPasswordCrypt($password);
        // Insertion de l'utilisateur dans la base de donnée
        $user = User::create(array_merge($requestUser->only('email'),
          [
            'password' => $password_crypt,
            'trainer_id' => $trainer->id
          ]));
        // Envoi mail d'inscription au nouveau formateur
        $data = array(
          'email' => $user->email,
          'first_name' => $trainer->first_name,
          'password' => $password
          );

        Mail::send('emails.registration', $data, function($message) use ($data) {
                $message->to($data['email'])->subject('Inscription AnthroPi');
        });
        return redirect()->route('trainers.index')
                         ->with('success', 'Le formateur a été créé. Un email lui a été envoyé avec ses identifiants de connexion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $today = Carbon::today();
        $trainer = Trainer::findOrFail($id);
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
        return view('admin.trainers.show', compact('trainer', 'nb_offer', 'nb_answer', 'today'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        $regions = Region::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        return view('admin.trainers.edit', compact('trainer', 'regions', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTrainerRequest $requestTrainer, EditUserRequest $requestUser, $id)
    {
        $trainer = Trainer::findOrFail($id);
        $user_id = $trainer->user->id;
        $user = User::findOrFail($user_id);
        // Stockage du CV
        if($requestTrainer->cv){
          $cv = $requestTrainer->cv->store('public/datadock/cv');
          $cv = str_replace('public/', '', $cv);
          $trainer->update(array_merge($requestTrainer->except('email','cv'), ['cv' => $cv]));
        }  else {
          $trainer->update($requestTrainer->except('email'));
        }
        // Insertion de l'utilisateur dans la base de données

        $user->update($requestUser->only('email'));
        return redirect()->route('trainers.index')
                         ->with('success', 'Le formateur a été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $trainer = Trainer::findOrFail($id);
      $user = $trainer->user;
      // Suppression du CV
      if($trainer->cv){
        unlink(storage_path('app/public/'.$trainer->cv));
      }

      // Suppression du formateur
      $trainer->delete();
      // Suppression du compte utilisateur
      $user->delete();
      return redirect()->route('trainers.index')
                       ->with('danger', 'Le formateur a été supprimé');
    }

    // Renvoie les statistiques des formateurs
    public function statistics(Request $request){
      // Tous les Formateurs
      $trainers = Trainer::orderBy('last_name')->get();
      // Tous les Niveaux
      $levels = Level::get();
      // Nombre de formations proposées par formateurs
      $formations_proposed = Trainer::formationsPerTrainer();
      // Nombre de mails de candidature reçu par formateur
      $emails_received = Trainer::emailsReceveidPerTrainer();
      // Renvoi toutes les données sur les formateurs qui ont participés aux formations (du plus grand nombre jusqu'au plus petit)
      $formations_participated = Trainer::formationTrainerValidate();
      // Renvoi toutes les données sur les formateurs ayant le plus candidaté mais dont la candidature a été le moins retenu
      $formations_refused = Trainer::formationsTrainerRefused();
      // Renvoi toutes les données sur les formateurs ayant le plus répondu aux mails de candidatures
      $emails_response = Trainer::emailsResponse();
      // Renvoi toutes les données sur les formateurs ayant le moins répondu aux mails de candidatures
      $emails_no_response = Trainer::emailsNoResponse();
      // Renvoi toutes les données sur les formateurs ayant le plus répondu favorablement aux mails de candidatures
      $emails_favorable = Trainer::emailsResponseFavorable();
      // Renvoi toutes les données sur les formateurs ayant le plus répondu défavorablement aux mails de candidatures
      $emails_unfavorable = Trainer::emailsResponseUnfavorable();
      // Tableau de; données à passer à la vue
      $data = [
        'emails_received' => $emails_received,
        'formations_proposed' => $formations_proposed,
        'formations_participated' => $formations_participated,
        'trainers' => $trainers,
        'levels' => $levels,
        'formations_refused' => $formations_refused,
        'emails_response' => $emails_response,
        'emails_no_response' => $emails_no_response,
        'emails_favorable' => $emails_favorable,
        'emails_unfavorable' => $emails_unfavorable
      ];
      view()->share('data', $data);
      if($request->has('download')){
        $pdf = PDF::loadView('pdf.statistics');
        return $pdf->download('statistiques.pdf');
      }
      return view('pdf.statistics');
    }

    // Génère un mot de passe aléatoire de 8 caractères
    private function getPassword(){
      $caracters = 'ABCDEFGHIJKMLNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $mixed = str_shuffle($caracters);
      $password = substr($mixed, 0, 8);
      return $password;
    }

    // Crypte les mots de passe
    private function getPasswordCrypt($password){
      $password = HASH::make($password);
      return $password;
    }


}
