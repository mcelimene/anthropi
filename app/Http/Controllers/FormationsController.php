<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;
use App\Trainer;
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
      if($formation->send_email){
        if($formation->number_of_assistant_trainers > 0 ){
          $trainers = Trainer::where('level_id', '1')->get();
          $this->sendEmails($trainers, $formation);
        }
        if($formation->number_of_trainers > 0 ){
          $trainers = Trainer::where('level_id', '2')->get();
          $this->sendEmails($trainers, $formation);
        }
        if($formation->number_of_instructors > 0 ){
          $trainers = Trainer::where('level_id', '3')->get();
          $this->sendEmails($trainers, $formation);
        }
        if($formation->number_of_course_directors > 0 ){
          $trainers = Trainer::where('level_id', '4')->get();
          $this->sendEmails($trainers, $formation);
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

    private function sendEmails($trainers, $formation){
      $data = array(
        'name' => $formation->name,
        'place' => $formation->place,
        'date_start' => $formation->date_start,
        'date_end' => $formation->date_end
      );
      foreach ($trainers as $trainer) {
        $data['email'] = $trainer->email;
        $data['first_name'] = $trainer->first_name;

        Mail::send('emails.availabilityRequest', $data, function($message) use ($data) {
                $message->to($data['email'])->subject('Demande de disponilité - AnthoPi');
        });
      }


    }
}
