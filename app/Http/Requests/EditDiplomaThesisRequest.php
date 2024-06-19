<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDiplomaThesisRequest extends FormRequest
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
            "topic_id" => "required|array|min:1",
            "topic_id.*" => "required|string|distinct|min:1",
            "teacher_id" => "required|array|min:1",
            "teacher_id.*" => "required|string|distinct|min:1",
            'availability' => 'mimes:pdf|max:5120',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A cím megadása kötelelző!',
            'topic_id.required' => 'Legkevesebb egy témakör megadása kötelező!',
            'topic_id.min' => 'Legkevesebb egy témakör megadása kötelező!',
            'topic_id.*.required' => 'Legkevesebb egy témakör megadása kötelező!',
            'topic_id.*.distinct' => 'Ugyanazt a témakör csak egyszer lehet kiválasztani!',
            'topic_id.*.min' => 'Legkevesebb egy témakör megadása kötelező!',


            'teacher_id.required' => 'Legkevesebb egy tanár megadása kötelező!',
            'teacher_id.min' => 'Legkevesebb egy tanár megadása kötelező!',
            'teacher_id.*.required' => 'Legkevesebb egy tanár megadása kötelező!',
            'teacher_id.*.distinct' => 'Ugyanazt a tanárt csak egyszer lehet kiválasztani!',
            'teacher_id.*.min' => 'Legkevesebb egy tanár megadása kötelező!',
            'availability.mimes' => 'A feltöltött file pdf kell legyen!',
            'availability.max' => 'A feltöltött file maximum 5mb lehet!'
        ];
    }
}
