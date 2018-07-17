<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationFormationsController extends Controller
{
    public function index(){
      return view('registrationFormations.index');
    }
}
