<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditNewRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A cím megadása kötelező!',
            'content.required' => 'A tartalom megadása kötelező!',
            'date.required' => 'A dátum megadása kötelező!',
        ];
    }
}
