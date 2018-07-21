<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Formation;
use App\Trainer;
use App\Level;
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
      dd($request->all());
      $formation = Formation::create($request->all());
      /*if($formation->send_email){
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
      }*/
      return redirect(route('admin.formations.index'));
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
      /*if($formation->send_email){
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
      }*/
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
      return redirect('admin.formations');
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
