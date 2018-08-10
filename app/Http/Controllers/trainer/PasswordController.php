<?php

namespace App\Http\Controllers\trainer;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function edit(){
    $admin_id = Auth::user()->id;
    $user = User::findOrFail($admin_id);
    return view('trainer.password.edit', compact('user'));
  }

  public function update(Request $request, $id){
    $user = User::findOrFail($id);
    // Si le champ mot de passe est rempli on le hashe et on l'insère dans la base de données
    if($request->input('password')){
      $password_crypt = HASH::make($request->input('password'));
      $user->password = $password_crypt;
      $user->save();
      return redirect()->route('home-trainer.index')->with('success', 'Votre mot de passe a été modifié avec succès');
    } else {
      return redirect()->route('home-trainer.index');
    }
  }
}
