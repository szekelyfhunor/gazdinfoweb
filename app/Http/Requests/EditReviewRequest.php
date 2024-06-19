<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
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
            'reviewer' => 'required',
            'opinion' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'reviewer.required' => 'A véleményező nevének megadása kötelező!',
            'opinion.required' => 'A vélemény megadása kötelező!',
            'image.mimes' => 'A kép jpg, jpeg, png kell legyen!',
            'image.max' => 'A kép maximum 2mb lehet!',
            'date.required' => 'A dátum megadása kötelező!',
        ];
    }
}
