<?php

namespace App\Http\Controllers\admin;

use App\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Message;
use App\Trainer;

class MessagesController extends Controller
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

    public function create(){
      $levels = Level::pluck('name', 'id');
      return view('admin.messages.create', compact('levels'));
    }

    public function send(MessageRequest $request){
      $levels = $request->input('level');
      // On récupère les formateurs niveau par niveau
      foreach ($levels as $level) {
        if($level != null){
          $trainers = Trainer::where('level_id', $level)->get();
          // On envoie le mail à chaque formateur concerné
          foreach ($trainers as $trainer) {
            $data = array(
              'adminName' => Auth::user()->name,
              'content' => $request->input('content'),
              'subject' => $request->input('subject')
            );
            //dd($data['content']);
            Mail::to($trainer->user->email)
                ->send(new Message($data));
          }
        }
      }
      return redirect()->route('home')
                       ->with('success', 'Le message a bien été envoyé');
    }
}
