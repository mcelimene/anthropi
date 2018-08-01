<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatadockRequest extends FormRequest
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
            'name' => 'bail|required|min:5',
            'file' => 'bail|required|file'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nom du fichier',
            'file' => 'Fichier'
        ];
    }



}
