<?php

namespace App\Http\Controllers\admin;

use App\Level;
use Illuminate\Http\Request;
use App\Http\Requests\LevelRequest;
use App\Http\Controllers\Controller;

class LevelsController extends Controller
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

    public function create(){
      return view('admin.levels.create');
    }

    public function store(LevelRequest $request){
      Level::create($request->except('_token'));
      return redirect(url('/'));
    }
}
