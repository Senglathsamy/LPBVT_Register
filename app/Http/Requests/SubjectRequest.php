<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'sub_id' => 'required|max:12|unique:subjects|regex:/(^[0-9a-zA-Z])/',
                    'sub_name' => 'required|max:50',
                    'sub_credit' => 'required|numeric|min:1',
                    'sub_unit1' => 'required|numeric',
                    'sub_unit2' => 'required|numeric',
                    'sub_unit3' => 'required|numeric',
                ];
            }
            case 'PATCH':
            {
                return [
//                    'sub_id' => 'required|max:12|unique:subjects',
                    'sub_name' => 'required|max:50',
                    'sub_credit' => 'required|numeric|min:1',
                    'sub_unit1' => 'required|numeric',
                    'sub_unit2' => 'required|numeric',
                    'sub_unit3' => 'required|numeric',
                ];
            }
        }
    }

    public function messages()
    {
        switch($this->method()){

            case 'POST':
            {
                return [
                        'sub_id.required' => 'ກະລຸນາປ້ອນລະຫັດວິຊາ',
                        'sub_id.max' => 'ກະລຸນາປ້ອນບໍ່ໃຫ້ກາຍ 12 ຕົວເລກ ຫຼື ອັກສອນ',
                        'sub_id.unique' => 'ລະຫັດທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ',
                        'sub_id.regex' => 'ກະລຸນາປ້ອນລະຫັດຕ້ອງເປັນຕົວເລກ 0-9 ຫຼື ຕົວອັກສອນ A-Z',
                        'sub_name.required' => 'ກະລຸນາປ້ອນຊື່ວິຊາ',
                        'sub_name.max' => 'ກະລຸນາປ້ອນບໍ່ໃຫ້ກາຍ 50 ອັກສອນ',
                        'sub_credit.required' => 'ກະລຸນາປ້ອນຈໍານວນໜ່ວຍກິດ',
                        'sub_credit.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ',
                        'sub_credit.min' => 'ກະລຸນາປ້ອນຈໍານວນໜ່ວຍກິດ ໃຫຍ່ກວ່າ 0',
                        'sub_unit1.required' => 'ກະລຸນາປ້ອນຈໍານວນຊົ່ວໂມງບັນຍາຍ',
                        'sub_unit1.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ',
                        'sub_unit2.required' => 'ກະລຸນາປ້ອນຈໍານວນຊົ່ວໂມງປະຕິບັດ',
                        'sub_unit2.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ',
                        'sub_unit3.required' => 'ກະລຸນາປ້ອນຈໍານວນຊົ່ວໂມງທົດລອງ',
                        'sub_unit3.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ'
                        ];
            }
            case 'PATCH':
            {
                return [
                        'sub_name.required' => 'ກະລຸນາປ້ອນຊື່ວິຊາ',
                        'sub_name.max' => 'ກະລຸນາປ້ອນບໍ່ໃຫ້ກາຍ 50 ອັກສອນ',
                        'sub_credit.required' => 'ກະລຸນາປ້ອນຈໍານວນໜ່ວຍກິດ',
                        'sub_credit.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ',
                        'sub_credit.min' => 'ກະລຸນາປ້ອນຈໍານວນໜ່ວຍກິດ ໃຫຍ່ກວ່າ 0',
                        'sub_unit1.required' => 'ກະລຸນາປ້ອນຈໍານວນຊົ່ວໂມງບັນຍາຍ',
                        'sub_unit1.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ',
                        'sub_unit2.required' => 'ກະລຸນາປ້ອນຈໍານວນຊົ່ວໂມງປະຕິບັດ',
                        'sub_unit2.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ',
                        'sub_unit3.required' => 'ກະລຸນາປ້ອນຈໍານວນຊົ່ວໂມງທົດລອງ',
                        'sub_unit3.numeric' => 'ກະລຸນາປ້ອນເປັນຕົວເລກ'
                        ];
            }
        }
    }
}
