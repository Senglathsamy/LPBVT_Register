<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DegreeRequest extends FormRequest
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
            'degree' => 'required',
            'program' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'degree.required' => 'ກະລຸນາປ້ອນລະດັບການສຶກສາ',
            'program.required' => 'ກະລຸນາປ້ອນລະບົບການສຶກສາ',
        ];
    }
}
