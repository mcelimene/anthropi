<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\UsersController;

class UsersController extends Controller
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

    public function create(){
      return view('admin.users.create');
    }

    public function store(UserRequest $request){
      // Mot de passe crypté
      $password = Hash::make('000000');
      User::create(array_merge($request->all(),['password' => $password, 'role' => 'admin']));
      return redirect()->route('home')
                       ->with('success', 'Le nouvel administrateur a bien été ajouté');
    }
}
