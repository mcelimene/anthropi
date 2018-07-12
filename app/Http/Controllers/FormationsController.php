<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;
use App\Http\Requests\EditFormationRequest;
use App\Trainer;

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
    {
      $formations = Formation::get();
      return view('formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('formations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditFormationRequest $request)
    {
      $formation = Formation::create($request->all());

      //$trainers = Trainer::where('level_id', '=', '1')->orWhere('level_id', '=', '2')->orWhere('level_id', '=', '4')->orWhere('level_id', '=', '3')->get();
      //dd($trainers);
        //array_push($trainers, Trainer::where('level_id', '=', $level_id)->pluck('email', 'first_name'));

      /*foreach ($trainers as $trainer) {
        dd($trainer);
      }*/
      // On insère dans un tableau le niveau requis et le nombre de formateurs nécessaires
      /*if($formation->number_of_assistant_trainers > 0 ){ $levels_id = array_push($levels_id, ['level_id' => 1]);}*/
      //$trainers = Trainer::where($levels_id)->get();
      /*
      if($formation->number_of_trainers > 0 ){ $levels_id = array_add($levels_id, 'formateur', $formation->number_of_trainers);}
      if($formation->number_of_instructors > 0 ){ $levels_id = array_add($levels_id, 'instructeur', $formation->number_of_instructors);}
      if($formation->number_of_course_directors > 0 ){ $levels_id = array_add($levels_id, 'directeur de cours', $formation->number_of_course_directors);}*/
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
      return view('formations.show', compact('formation'));
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
      return view('formations.edit', compact('formation'));
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
      return redirect(route('formations.index'));
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

    private function sendEmails(array $trainers_level){
      $trainers = Trainer::get()->where($trainers_level);
      dd($trainers);
      /*$data = array(
        'email' => $trainer->email,
        'first_name' => $trainer->first_name,
        'pseudo' => $pseudo,
        'password' => $password
      );*/

      /*Mail::send('emails.registration', $data, function($message) use ($data) {
              $message->to($data['email'])->subject('Inscription AnthroPi');
      });*/
    }
}
