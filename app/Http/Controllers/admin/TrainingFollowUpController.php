<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Formation;
use App\Level;

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
      $formations = Formation::where('validation_registrations', false)->where('send_email', true)->get();
      $today = Carbon::today();
      return view('trainingFollowUp.index', compact('formations', 'today'));
    }

    public function update(){

    }
}
