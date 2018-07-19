<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajax_call(){
      \Log::info("ajax_call()");
      return 'success';
    }
}
