<?php

namespace App\Http\Controllers\admin;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DatadockRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Trainer;
use App\Datadock;

class DatadockController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function index(){
      return view('admin.datadock.index');
    }

    public function create(){
      return view('admin.datadock.create');
    }

    public function store(DatadockRequest $request){
      // Stockage du fichier
      $file = $request->file->store('public/datadock/files');
      $file = str_replace('public/', '', $file);
      // Insertion du fichier dans la base de données
      $datadock = Datadock::create(array_merge($request->except('_token', 'file'), ['path' => $file]));

      return redirect()->route('datadock.index')
                       ->with('success', 'Le fichier a été ajouté');
    }

    public function dataTrainers(){
      $trainers = Trainer::orderBy('last_name')->get()->pluck('full_name', 'id');
      return view('admin.datadock.dataTrainers', compact('trainers'));
    }

    public function dataTrainersStore(Request $request){
      // On récupére les formateurs sélectionnés
      if($request->choiceTrainers == 'all'){
        $trainers = Trainer::select(array_merge($request->column, ['first_name', 'last_name']))->with('region', 'level')->orderBy('last_name')->get();
      } else {
        $trainers = Trainer::select($request->column, 'first_name', 'last_name')->whereIn('id', $request->trainers)->with('region', 'level')->orderBy('last_name')->get();
      }
      // On créé le fichier PDF avec les données de formateurs précédement sélectionnés
      $pdf = PDF::loadView('pdf.datadock', compact('trainers', 'name'));
      return $pdf->download('liste_formateurs.pdf');
    }

    public function all(){
      // On récupère tous les fichiers
      $files = Datadock::orderBy('created_at', 'DESC')->paginate(10);
      // On récupère tous les formateurs ayant un cv
      $trainers = Trainer::whereNotNull('cv')->orderBy('last_name', 'ASC')->paginate(10);
      return view('admin.datadock.all', compact('files', 'trainers'));
    }

}
