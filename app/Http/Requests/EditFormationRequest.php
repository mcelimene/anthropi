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
        'time_start' => 'bail|required',
        'date_end' => 'bail|required',
        'time_end' => 'bail|required',
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
          'time_start' => 'Heure de début',
          'date_end' => 'Date de fin',
          'time_end' => 'Heure de fin',
          // 'send_email' => "Envoi d'e-mails"
        ];
    }
}
