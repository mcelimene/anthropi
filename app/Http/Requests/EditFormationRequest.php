<?php

namespace App\Http\Requests;

use  App\Trainer;
use Illuminate\Foundation\Http\FormRequest;

class EditFormationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $instructorsMax = Trainer::where('level_id', 3)->count();
      $assistantTrainersMax = Trainer::where('level_id', 1)->count();
      $trainersMax = Trainer::where('level_id', 2)->count();
      $directorsMax = Trainer::where('level_id', 4)->count();
      return [
        'name' => 'bail|required|min:3',
        'place' => 'bail|required|min:3',
        'date_start' => 'bail|required',
        'date_end' => 'bail|required',
        'number_of_instructors' => 'bail|numeric|min:0|max:'.$instructorsMax,
        'number_of_trainers' => 'bail|numeric|min:0|max:'.$trainersMax,
        'number_of_assistant_trainers' => 'bail|numeric|min:0|max:'.$assistantTrainersMax,
        'number_of_course_directors' => 'bail|numeric|min:0|max:'.$directorsMax,
        'educational_objective' => 'bail|required|min:10',
        // 'send_email' => 'bail|boolean'
      ];
    }

    public function attributes()
    {
        return [
          'name' => 'Nom',
          'place' => 'Lieu',
          'date_start' => 'Date de début',
          'date_end' => 'Date de fin',
          'number_of_trainers' => 'Nombre de formateurs',
          'number_of_assistant_trainers' => "Nombre d'assistant-formateurs",
          'number_of_instructors' => "Nombre d'instructeurs",
          'number_of_course_directors' => "Nombre de directeurs de cours",
          'educational_objective' => 'Objectifs pédagogiques',
          // 'send_email' => "Envoi d'e-mails"
        ];
    }
}
