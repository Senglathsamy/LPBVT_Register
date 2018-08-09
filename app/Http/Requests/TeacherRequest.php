<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'te_firstname' => 'required|max:50',
            'te_lastname' => 'required|max:50',
            'te_gender' => 'required',
            'te_nationality' => 'required|max:12',
            'te_region' => 'required|max:10',
            'te_phone' => 'required|min:10|numeric|regex:/(^[0-9]{10})/',
            'te_major' => 'required|max:25',
            'te_degree' => 'required',
            'dept_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'te_firstname.required' => 'ກະລຸນາປ້ອນຊື່ອາຈານ',
            'te_lastname.required' => 'ກະລຸນາປ້ອນນາມສະກຸນອາຈານ',
            'te_gender.required' => 'ກະລຸນາເລືອກເພດ',
            'te_nationality.required' => 'ກະລຸນາປ້ອນສັນຊາດ',
            'te_nationality.max' => 'ກະລຸນາປ້ອນສັນຊາດບໍ່ໃຫ້ກາຍ 12 ຄຳ',
            'te_region.required' => 'ກະລຸນາປ້ອນສາດສະໜາ',
            'te_region.max' => 'ກະລຸນາປ້ອນສາດສະໜາບໍ່ໃຫ້ກາຍ 10 ຄຳ',
            'te_phone.required' => 'ກະລຸນາປ້ອນເບີໂທລະສັບ',
            'te_phone.numeric' => 'ກະລຸນາໃສ່ ເບີໂທ ເປັນຕົວເລກເທົ່ານັ້ນ',
            'te_phone.min' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 10 ໂຕ (020...,030...)',
            'te_phone.regex' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 10 ໂຕ (020...,030...)',
            'te_major.required' => 'ກະລຸນາປ້ອນສາຂາ',
            'te_major.min' => 'ກະລຸນາປ້ອນສາຂາບໍ່ໃຫ້ກາຍ 25 ຄຳ',
            'te_degree.required' => 'ກະລຸນາເລືອກລະດັບການສຶກສາ',
            'dept_id.required' => 'ກະລຸນາເລືອກສັງກັດພາກວິຊາ',
        ];
    }
}
