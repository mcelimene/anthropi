<?php

namespace App\Http\Controllers\datadock;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function edit(){
      $id = \Auth::user()->id;
      $datadock = User::findOrFail($id);
      return view('datadock.settings.edit',compact('datadock'));
    }

    public function update(Request $request){
      $id = \Auth::user()->id;
      $datadock = User::findOrFail($id);
      $emailValidate = $request->validate([
        'email' => 'bail|required|email'
      ]);
      $datadock->email = $request->email;
      // Si le champ mot de passe est rempli on le hashe et on l'insère dans la base de données
      if($request->input('password')){
        $password_crypt = HASH::make($request->input('password'));
        $datadock->password = $password_crypt;
      }
      $datadock->save();
      return redirect('/home-datadock');
    }
}
