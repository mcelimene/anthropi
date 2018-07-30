<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Datadock;

class DatadockController extends Controller
{
    public function index(){
      $files = Datadock::get();
      return view('admin.datadock.index');
    }

    public function create(){

    }

    public function store(){

    }
}
