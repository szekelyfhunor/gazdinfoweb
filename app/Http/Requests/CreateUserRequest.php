<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

class CreateUserRequest extends FormRequest
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
        if ($this->request->has('classes_id') || $this->request->has('workplace') || $this->request->has('year_of_finish') || $this->request->has('status')) {
            return [
                'name' => 'required',
                'email' => 'nullable|email|unique:users',
                'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'image' => 'mimes:jpg,jpeg,png|max:2048',
                'classes_id' => 'required',
                'year_of_finish' => 'nullable|digits:4|integer|min:2016|max:' . (date('Y') + 5),
                'status' => 'required',
            ];
        } else if ($this->request->has('degree') || $this->request->has('post')) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'image' => 'mimes:jpg,jpeg,png|max:2048',
                'post' => 'required',
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'image' => 'mimes:jpg,jpeg,png|max:2048',
            ];
        }

    }

    public function messages()
    {
        return [
            'name.required' => 'A név megadása kötelező',
            'email.required' => 'Az emailcím megadása kötelező!',
            'email.email' => 'Adjon meg egy valós email címet!',
            'email.unique' => 'Az emailcím már használatban van!',
            'phone.regex' => 'Adjon meg egy valós telefonszámot!',
            'phone.min' => 'A telefonszám minimum 10 karakter hosszú kell legyen!',
            'image.mimes' => 'A kép jpg, jpeg, png kell legyen!',
            'image.max' => 'A kép maximum 2mb lehet!',

            'classes_id.required' => 'Az osztály megadása kötelező!',
            'year_of_finish.digits' => 'Az végzés éve 4 számjegyből kell álljon!',
            'year_of_finish.integer' => 'Az végzés éve szám kell legyen!',
            'year_of_finish.min' => 'A legkissebb megadható végzési év 2000!',
            'year_of_finish.max' => 'A legnagyobb megadható végzési év ' . (date('Y') + 5) . '!',
            'status.required' => 'Az státusz megadása kötelező!',

            'post.required' => 'A beosztás megadása kötelező!',

        ];
    }

}
