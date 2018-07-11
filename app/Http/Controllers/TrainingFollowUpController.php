<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingFollowUpController extends Controller
{
    public function index(){
      return view('trainingFollowUp.index');
    }
}
