<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopicRequest extends FormRequest
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
            'name' => 'required|unique:topics'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A név megadása kötelező!',
            'name.unique' => 'Ilyen nevü témakör már létezik!'
        ];

    }
}
