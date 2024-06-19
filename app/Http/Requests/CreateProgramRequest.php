<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProgramRequest extends FormRequest
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
            'institution' => 'required',
            'faculty' => 'required',
            'name_hu' => 'required',
            'name_ro' => 'required',
            'study_level' => 'required',
            'field_of_study' => 'required',
            'accreditation' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'institution.required' => 'Az intézmény megadása kötelező!',
            'faculty.required' => 'A kar megadása kötelező!',
            'name_hu.required' => 'A szaknév(HU) megadása kötelező!',
            'name_ro.required' => 'A szaknév(RO) megadása kötelező!',
            'study_level.required' => 'A képzési szint megadása kötelező!',
            'field_of_study.required' => 'A képzési ág megadása kötelező!',
            'accreditation.required' => 'Az akkreditáció megadása kötelező',
            'description.required' => 'Az leírás megadása kötelező!',
        ];
    }
}
