<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelUserCreateRequest extends FormRequest
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
            'file' => 'required|mimes:xlsx,xls',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'A file megadása kötelező!',
            'file.mimes' => 'A megadott file csak excel lehet!'
        ];

    }
}
