<?php

namespace App\Http\Requests;

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
      return [
        'name' => 'bail|required|min:3',
        'place' => 'bail|required|min:3',
        'date_start' => 'bail|required',
        'date_end' => 'bail|required',
        'number_of_instructors' => 'bail|numeric|min:0',
        'number_of_trainers' => 'bail|numeric|min:0',
        'number_of_assistant_trainers' => 'bail|numeric|min:0',
        'number_of_course_directors' => 'bail|numeric|min:0',
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
