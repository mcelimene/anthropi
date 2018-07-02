<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTrainerRequest extends FormRequest
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
          'first_name' => 'bail|required|min:3',
          'last_name' => 'bail|required|min:3',
          'email' => 'bail|required|email',
          'rank' => 'bail|required|min:2',
          'speciality' => 'bail|required|min:2',
          'level_id' => 'bail|required',
          'region_id' => 'bail|required'
        ];
    }

    public function attributes()
    {
        return [
          'first_name' => 'Prénom',
          'last_name' => 'Nom',
          'email' => 'E-mail',
          'rank' => 'Grade',
          'speciality' => 'Spécialité',
          'level_id' => 'Niveau',
          'region_id' => 'Région'
        ];
    }
}
