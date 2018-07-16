<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;

class TrainingFollowUpController extends Controller
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
    public function index(){
      $formations = Formation::where('send_email', true)->get();
      return view('trainingFollowUp.index');
    }
}
