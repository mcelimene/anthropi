<?php

namespace App\Http\Controllers;

use App\User;
use App\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.nse
     */
    public function index()
    {
        $admin_id = Auth::user()->id;
        $admin = User::findOrFail($admin_id);
        return view('admin.home', compact('admin'));
    }
}
