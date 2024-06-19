<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassRequest extends FormRequest
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
            'current_grade' => 'required',
            'enrolled' => 'required|min:1',
            'is_finished' => 'required',
            'graduated_number' => 'required_if:is_finished,==,1|nullable|min:0|lte:enrolled',
            'year' => 'required|digits:4|integer|unique:classes|min:2000|max:' . (date('Y')) . '!',
            'academic_calendar' => 'mimes:pdf|max:10210',
            'curriculum' => 'mimes:pdf||max:10210',
            'timetable' => 'mimes:pdf||max:10210',
        ];
    }

    public function messages()
    {
        return [
            'current_grade.required' => 'Az aktuális évfolyam megadása kötelező!',
            'enrolled.required' => 'A beiratkozottak számát kötelező megadni!',
            'graduated_number.required_if' => 'A végzettek számát kötelező megadni!',
            'graduated_number.lte' => 'A végzettek száma nem lehet nagyobb a beiratkozottak számánál!',
            'graduated_number.min' => 'A végzettek száma nem lehet negatív szám!',
            'is_finished.required' => 'Kötelező megadni, hogy végzette!',
            'year.required' => 'Az évszám megadása kötelező!',
            'year.digits' => 'Az évszám 4 számjegyből kell álljon!',
            'year.min' => 'A legkissebb megadható évszám 2000!',
            'year.max' => 'A legnagyobb megadható évszám ' . (date('Y')) . '!',
            'year.integer' => 'Az évszám szám kell legyen!',
            'year.unique' => 'Ezzel az évszámmal már létezik évfolyam!',
            'academic_calendar.mimes' => 'A feltöltött tanévszerkezet pdf kell legyen!',
            'academic_calendar.max' => 'A feltöltött tanévszerkezet maximum 10mb lehet!',
            'curriculum.mimes' => 'A feltöltött tanterv pdf kell legyen!',
            'curriculum.max' => 'A feltöltött tanterv maximum 10mb lehet!',
            'timetable.mimes' => 'A feltöltött órarend pdf kell legyen!',
            'timetable.max' => 'A feltöltött órarend maximum 10mb lehet!'
        ];
    }


}
