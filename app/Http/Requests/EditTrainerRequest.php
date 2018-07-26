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
          'job' => 'bail|required|min:2',
          'speciality' => 'bail|required|min:2',
          'level_id' => 'bail|required',
          'region_id' => 'bail|required',
          'address' => 'bail|required',
          'birthdate' => 'bail|required'
        ];
    }

    public function attributes()
    {
        return [
          'first_name' => 'Prénom',
          'last_name' => 'Nom',
          'job' => 'Profession',
          'speciality' => 'Spécialité',
          'level_id' => 'Niveau',
          'region_id' => 'Région',
          'address' => 'Adresse',
          'birthdate' => 'Date de naissance'
        ];
    }
}
