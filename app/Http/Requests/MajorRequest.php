<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajorRequest extends FormRequest
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
            'ma_name' => 'required',
            'dept_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ma_name.required' => 'ກະລຸນາປ້ອນຊື່ສາຂາວິຊາ',
            'dept_id.required' => 'ກະລຸນາເລືອກພາກວິຊາ',
        ];
    }
}
