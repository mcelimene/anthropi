<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfilRequest;

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

    public function update(EditProfilRequest $request, $id){
      $user = User::findOrFail($id);
      // On hashe le mot de passe
      $password_crypt = HASH::make($request->input('password'));

      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $password_crypt;
      $user->save();
      return redirect(url('/'));
    }

    public function destroy($id){
      $user = User::findOrFail($id);
      $user->delete();
      return redirect(route('logout'));
    }
}
