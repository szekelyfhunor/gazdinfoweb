<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'A régi jelszó megadása kötelelző!',

            'new_password.required' => 'Az új jelszó megadása kötelelző!',
            'new_password.min' => 'Az új jelszó minimum 8 karakter kell legyen!',

            'confirm_password.required' => 'A új jelszó megerősítése kötelelző!',
            'confirm_password.same' => 'Az új jelszó nem egyezik meg a megerősített jelszóval!',
        ];
    }

}
