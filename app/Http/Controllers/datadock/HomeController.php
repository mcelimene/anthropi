<?php

namespace App\Http\Controllers\datadock;

use App\Trainer;
use App\Datadock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(){
    // On récupère tous les fichiers
    $files = Datadock::orderBy('created_at', 'DESC')->get();
    // On récupère tous les formateurs ayant un cv
    $trainers = Trainer::whereNotNull('cv')->orderBy('last_name', 'ASC')->get();
    return view('datadock.home', compact('files', 'trainers'));
  }
}
