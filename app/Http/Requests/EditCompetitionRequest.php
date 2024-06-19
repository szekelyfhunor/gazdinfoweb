<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCompetitionRequest extends FormRequest
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
            'location' => 'required',
            'type_of_participation_id' => 'required',
            'result' => 'required',
            'date' => 'required',
            "student_id" => "required|array|min:1",
            "student_id.*" => "required|integer|distinct|min:1",
            'availability' => 'mimes:pdf|max:5120'
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'A cím megadása kötelező',
            'location.required' => 'A helyszín megadása kötelező',
            'type_of_participation_id.required' => 'A Részvétel típusának megadása kötelező',
            'result.required' => 'Az eredmény megadása kötelező',
            'date.required' => 'A dátum megadása kötelező',


            'student_id.required' => 'Legkevesebb egy hallgató megadása kötelező!',
            'student_id.min' => 'Legkevesebb egy hallgató megadása kötelező!',
            'student_id.*.distinct' => 'Ugyanazt a hallgatót csak egyszer lehet kiválasztani!',
            'student_id.*.min' => 'Legkevesebb egy hallgató megadása kötelező!',
            'student_id.*.required' => 'Legkevesebb egy hallgató megadása kötelező',

            'availability.mimes' => 'A feltöltött file pdf kell legyen!',
            'availability.max' => 'A feltöltött file maximum 5mb lehet!'
        ];
    }

}
