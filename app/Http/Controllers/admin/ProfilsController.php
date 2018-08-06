<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class ProfilsController extends Controller
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

    public function edit(){
      $admin_id = Auth::user()->id;
      $user = User::findOrFail($admin_id);
      return view('admin.profils.edit', compact('user'));
    }

    public function update(UserRequest $request, $id){
      $user = User::findOrFail($id);
      // Si le champ mot de passe est rempli on le hashe et on l'insère dans la base de données
      if($request->input('password')){
        $password_crypt = HASH::make($request->input('password'));
        $user->password = $password_crypt;
      }

      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();
      return redirect()->route('home')
                       ->with('success', 'Votre profil a bien été mis à jour');
    }

    public function destroy($id){
      $user = User::findOrFail($id);
      $user->delete();
      return redirect(route('logout'));
    }
}
