<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTypeOfParticipationtRequest extends FormRequest
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
            'name' => ['required', Rule::unique('type_of_participations')->ignore($this->typeofparticipation->id)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A név megadása kötelező!',
            'name.unique' => 'Ilyen nevü részvétel típus már létezik!'
        ];

    }
}
