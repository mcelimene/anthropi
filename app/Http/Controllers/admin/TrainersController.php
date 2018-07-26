<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Level;
use App\Region;
use App\Trainer;
use App\User;
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
    {   // Création du mot de passe
        $password = $this->getPassword();
        $password = $this->getPasswordCrypt($password);
        // Insertion du formateur dans la base de données
        $trainer = Trainer::create($requestTrainer->except('email'));
        // Insertion de l'utilisateur dans la base de donnée
        $user = User::create(array_merge($requestUser->only('email'),
          [
            'password' => $password,
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

        return redirect(route('trainers.index'));
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
        // Insertion de l'utilisateur dans la base de données
        $trainer->update($requestTrainer->except('email'));
        $user->update($requestUser->only('email'));
        return redirect(route('trainers.index'));
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
        $trainer->delete();
        $user->delete();
        return redirect('trainers');
    }

    public function pdfView(Request $request){
      $trainers = Trainer::get();
      view()->share('trainers', $trainers);

      if($request->has('download')){
        $pdf = PDF::loadView('pdfview');
        return $pdf->download('liste_formateurs.pdf');
      }
      return view('pdfview');
    }

    private function getPassword(){
      $caracters = 'ABCDEFGHIJKMLNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $mixed = str_shuffle($caracters);
      $password = substr($mixed, 0, 8);
      return $password;
    }

    private function getPasswordCrypt($password){
      $password = HASH::make($password);
      return $password;
    }

    /*private function skip_accents($str, $charset='utf-8') {
      $str = htmlentities( $str, ENT_NOQUOTES, $charset );
      $str = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str );
      $str = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $str );
      $str = preg_replace( '#&[^;]+;#', '', $str );
      return $str;
    }*/


    /*private function getPseudo($first_name, $last_name){
      $pseudo = substr($first_name, 0, 1) . $last_name;
      // Minuscules
      $pseudo = strtolower($pseudo);
      // sans accent
      $pseudo = $this->skip_accents($pseudo);
      return $pseudo;
    }*/

}
