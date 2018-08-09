<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        switch($this->method()){

            case 'POST':
            {
                return [
                    'st_id' => 'required|max:12|unique:students',
                    'st_fname' => 'required|max:50',
                    'st_lname' => 'required|max:50',
                    'st_fname_eng' => 'max:50',
                    'st_lname_eng' => 'max:50',
                    'st_gender' => 'required',
                    'st_bdate' => 'required',
                    'st_bvillage' => 'required|max:25',
                    'st_bdistrict' => 'required|max:10',
                    'st_nationality' => 'required|max:12',
                    'st_region' => 'required|max:10',
                    'st_phone' => 'required|min:6',
                    'st_pvillage' => 'required|max:25',
                   'st_pdistrict' => 'required|max:10',
                    'gr_fname' => 'required|max:25',
                    'gr_lname' => 'required|max:25',
                    'gr_phone' => 'required|min:6',
                    'gr_gender' => 'required',
                    'ma_id' => 'required',
                    'de_id' => 'required',
                ];
            }
            case 'PATCH':
            {
                return [
                    'st_fname' => 'required|max:50',
                    'st_lname' => 'required|max:50',
                    'st_fname_eng' => 'max:50',
                    'st_lname_eng' => 'max:50',
                    'st_gender' => 'required',
                    'st_bdate' => 'required',
                    'st_bvillage' => 'required|max:25',
                    'st_bdistrict' => 'required|max:10',
                    'st_nationality' => 'required|max:12',
                    'st_region' => 'required|max:10',
                    'st_phone' => 'required|min:6',
                    'st_pvillage' => 'required|max:25',
                    'st_pdistrict' => 'required|max:10',
                    'gr_fname' => 'required|max:25',
                    'gr_lname' => 'required|max:25',
                    'gr_phone' => 'required|min:6',
                    'ma_id' => 'required',
                    'de_id' => 'required',
                ];
            }
        }

    }

    public function messages()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'st_id.unique' => 'ລະຫັດນັກສຶກສານີ້ມີແລ້ວ ກະລຸນາກວດສອບ',
                    'st_fname.max' => 'ກະລຸນາປ້ອນຊື່ນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 50 ຄຳ',
                    'st_lname.max' => 'ກະລຸນາປ້ອນນາມສະກຸນນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 50 ຄຳ',

                    'st_bvillage.max' => 'ກະລຸນາປ້ອນບ້ານເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',
                    'st_bdistrict.max' => 'ກະລຸນາປ້ອນເມືອງເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',

                    'st_pvillage.max' => 'ກະລຸນາປ້ອນບ້ານເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',
                    'st_pdistrict.max' => 'ກະລຸນາປ້ອນເມືອງເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 10 ຄຳ',

                    'st_phone.min' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 6 ໂຕ (020...,030...)',

                    'gr_phone.numeric' => 'ກະລຸນາໃສ່ ເບີໂທ ເປັນຕົວເລກເທົ່ານັ້ນ',
                    'gr_phone.min' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 6 ໂຕ (020...,030...)',
                ];
            }
            case 'PATCH':
            {
                return [
                    'st_fname.max' => 'ກະລຸນາປ້ອນຊື່ນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 50 ຄຳ',
                    'st_lname.max' => 'ກະລຸນາປ້ອນນາມສະກຸນນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 50 ຄຳ',

                    'st_bvillage.max' => 'ກະລຸນາປ້ອນບ້ານເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',
                    'st_bdistrict.max' => 'ກະລຸນາປ້ອນເມືອງເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',
                    'st_bprovince.max' => 'ກະລຸນາປ້ອນແຂວງເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',

                    'st_pvillage.max' => 'ກະລຸນາປ້ອນບ້ານເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',
                    'st_pdistrict.max' => 'ກະລຸນາປ້ອນເມືອງເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',
                    'st_pprovince.max' => 'ກະລຸນາປ້ອນແຂວງເກີດຂອງນັກສຶກສາ ບໍ່ໃຫ້ເກີນ 25 ຄຳ',

                    'st_phone.numeric' => 'ກະລຸນາໃສ່ ເບີໂທ ເປັນຕົວເລກເທົ່ານັ້ນ',
                    'st_phone.min' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 10 ໂຕ (020...,030...)',
                    'st_phone.regex' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 10 ໂຕ (020...,030...)',

                    'gr_phone.numeric' => 'ກະລຸນາໃສ່ ເບີໂທ ເປັນຕົວເລກເທົ່ານັ້ນ',
                    'gr_phone.min' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 10 ໂຕ (020...,030...)',
                    'gr_phone.regex' => 'ກະລຸນາໃສ່ ເບີໂທ ບໍ່ໃຫ້ຫຼຸດ 10 ໂຕ (020...,030...)',
                ];
            }
        }

    }
}
