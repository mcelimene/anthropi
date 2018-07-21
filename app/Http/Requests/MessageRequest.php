<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'subject' => 'bail|required|min:5',
            'content' => 'bail|required|min:10',
            'level' => 'bail|required'
        ];
    }

    public function attributes()
    {
        return [
          'subject' => 'Objet du message',
          'content' => 'Message',
          'level' => 'Niveau'
        ];
    }
}
