<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePartnerRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A partner nevének megadása kötelező!',
            'image.required' => 'A kép megadása kötelező!',
            'image.mimes' => 'A kép jpg, jpeg, png kell legyen!',
            'image.max' => 'A kép maximum 2mb lehet!',
        ];
    }
}
