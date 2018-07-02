<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Region;
use App\Trainer;
use App\Http\Requests\EditTrainerRequest;

class TrainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = Trainer::with('level', 'region')->get();
        return view('trainers.index', compact('trainers'));
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
        return view('trainers.create', compact('regions', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditTrainerRequest $request)
    {   // Création automatique du pseudo et du mot de passe
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $pseudo = $this->getPseudo($first_name, $last_name);
        $password = $this->getPassword();
        $password_crypt = $this->getPasswordCrypt($password);

        $trainer = Trainer::create(array_merge($request->all(),
          [
            'password' => $password,
            'password_crypt' => $password_crypt,
            'pseudo' => $pseudo
          ]));
        return redirect(route('trainers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('trainers.edit', compact('trainer', 'regions', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTrainerRequest $request, $id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->update($request->all());
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
        $trainer->delete();
        return redirect('trainers');
    }

    private function getPassword(){
      $caracters = 'ABCDEFGHIJKMLNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $mixed = str_shuffle($caracters);
      $password = substr($mixed, 0, 8);
      return $password;
    }

    private function getPasswordCrypt($password){
      $password = password_hash($password, PASSWORD_DEFAULT);
      return $password;
    }

    private function getPseudo($first_name, $last_name){
      $pseudo = substr($first_name, 0, 3) . substr($last_name, 0, 3);
      return $pseudo;
    }
}
