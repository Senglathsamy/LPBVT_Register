<?php

namespace App\Http\Controllers;

use App\Student;
use App\Register;
use App\Upgrade;
use Illuminate\Http\Request;
use Excel;

class ExportExcelController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function studentExport(Request $request)
    {
        $year = $request->year;
        $classno = $request->classno;
        $academicyear = $request->academicyear;
        $ma_id = $request->ma_id;
        $student = [];

        if (!empty($classno)) {
            $std = Student::query()->where('ma_id', $ma_id)->get(['st_id']);
            if (count($std) > 0) {
                foreach ($std as $st) {
                    $student[] = Register::query()
                        ->where('rg_studyyear', $year)
                        ->where('rg_classno', $classno)
                        ->where('rg_academicyear', $academicyear)
                        ->where('st_id', $st->st_id)
                        ->get();
                }
            }
        }else{
            return back();
        }

        /**
         * Make Array
         */
        $student_export = [];
        $i = 0;
        $ma = $de = '';

        foreach ($student as $stds) {

            foreach ($stds as $std) {

                $ma = $std->student->major->ma_name;
                $de = $std->student->degree->degree . $std->student->degree->program;

                $student_export[] = [
                    'ລຳດັບ' => ++$i,
                    'ລະຫັດນັກສຶກສາ' => $std->student->st_id,
                    'ຊື່ ແລະ ນາມສະກຸນ' => $std->student->st_fname . ' ' . $std->student->st_lname,
                    'ເພດ' => $std->student->st_gender,
                    'ວັນເດືອນປີເກີດ' => $std->student->st_bdate,
                    'ບ້ານເກີດ' => $std->student->st_bvillage,
                    'ເມືອງເກີດ' => $std->student->st_bdistrict,
                    'ແຂວງເກີດ' => $std->student->st_bprovince,
                    'ສັນຊາດ' => $std->student->st_nationality,
                    'ສາດສະໜາ' => $std->student->st_region,
                    'ເບີໂທ' => $std->student->st_phone,
                    'ບ້ານຢູ່ປັດຈຸບັນ' => $std->student->st_pvillage,
                    'ເມືອງຢູ່ປັດຈຸບັນ' => $std->student->st_pdistrict,
                    'ແຂວງຢູ່ປັດຈຸບັນ' => $std->student->st_pprovince,
                    'ຊື່ ແລະ ນາມສະກຸນຜູ້ປົກຄອງ' => $std->student->gr_fname . ' ' . $std->student->gr_lname,
                    'ເບີໂທລະສັບຜູ້ປົກຄອງ' => $std->student->gr_phone,
                    'ເພດຜູ້ປົກຄອງ' => $std->student->gr_gender,
                    'ປີເຂົ້າຮຽນ' => $std->student->st_registerdate,
                    'ສາຂາຮຽນ' => $std->student->major->ma_name,
                    'ລະບົບ' => $std->student->degree->degree . ' (' . $std->student->degree->program . ')',
                    'ພາກວິຊາ' => $std->student->major->department->dept_name,
                ];

            }

        }

        /**
         * Return To Download
         */
        return Excel::create('ລາຍງານຂໍ້ມູນນັກສຶກສາ-'.$ma . '-' . $de, function($excel) use ($student_export) {
            $excel->sheet('mySheet', function($sheet) use ($student_export)
            {
                $sheet->fromArray($student_export);
            });
        })->download('xlsx');

    }//End studentExport------------------------------------------------------------------------------------------------

    public function registerExport(Request $request)
    {
        $year = $request->year;
        $academicyear = $request->academicyear;

        if (!empty($academicyear)) {

            if (!empty($year)) {
                $register = Register::query()
                    ->where('rg_studyyear', $year)
                    ->where('rg_academicyear', $academicyear)
                    ->get();
            }else{
                $register = Register::query()
                    ->where('rg_academicyear', $academicyear)
                    ->get();
            }

        }else{
            return back();
        }

        /**
         * Make Array
         */
        $register_export = [];
        $i = 0;

        foreach ($register as $reg) {

            $register_export[] = [
                'ລຳດັບ' => ++$i,
                'ລະຫັດນັກສຶກສາ' => $reg->student->st_id,
                'ຊື່ ແລະ ນາມສະກຸນ' => $reg->student->st_fname . ' ' . $reg->student->st_lname,
                'ເພດ' => $reg->student->st_gender,
                'ປີ' => $reg->rg_studyyear,
                'ຫ້ອງ' => $reg->rg_classno,
                'ສົກຮຽນ' => $reg->rg_academicyear,
                'ສາຂາຮຽນ' => $reg->student->major->ma_name,
                'ລະບົບ' => $reg->student->degree->degree . ' (' . $reg->student->degree->program . ')',
                'ພາກວິຊາ' => $reg->student->major->department->dept_name,
                'ວັນທີຈ່າຍ' => $reg->rg_paiddate,
                'ເລກໃບບິນ' => $reg->rg_recieptno,
            ];

        }

        /**
         * Return To Download
         */
        return Excel::create('ລາຍງານຂໍ້ມູນລົງທະບຽນຮຽນ-ສົກຮຽນ '.$academicyear, function($excel) use ($register_export) {
            $excel->sheet('mySheet', function($sheet) use ($register_export)
            {
                $sheet->fromArray($register_export);
            });
        })->download('xlsx');

    }//End registerExport------------------------------------------------------------------------------------------------


    public function upgradeExport(Request $request)
    {
        $academicyear = $request->academicyear;
        $upgrade = [];
        if (!empty($academicyear)) {
            $register = Register::query()
                ->where('rg_academicyear', $academicyear)
                ->get(['st_id']);

            if (count($register) > 0) {
                foreach ($register as $reg) {
                    $upgrade[] = Upgrade::query()->where('st_id', $reg->st_id)->get();
                }
            }else{
                return back();
            }
        }else{
            return back();
        }

        /**
         * Make Array
         */
        $upgrade_export = [];
        $i = 0;
        foreach ($upgrade as $upg) {

            foreach ($upg as $ug) {

                $upgrade_export[] = [
                    'ລຳດັບ' => ++$i,
                    'ລະຫັດນັກສຶກສາ' => $ug->student->st_id,
                    'ຊື່ ແລະ ນາມສະກຸນ' => $ug->student->st_fname . ' ' . $ug->student->st_lname,
                    'ເພດ' => $ug->student->st_gender,
                    'ວັນທີຈ່າຍ' => $ug->ug_paiddate,
                    'ເລກໃບບິນ' => $ug->ug_recieptno,
                ];

            }

        }

        /**
         * Return To Download
         */
        return Excel::create('ລາຍງານການລົງທະບຽນແກ້ເກຣດ-ປະຈຳສົກຮຽນ'.$academicyear, function($excel) use ($upgrade_export) {
            $excel->sheet('mySheet', function($sheet) use ($upgrade_export)
            {
                $sheet->fromArray($upgrade_export);
            });
        })->download('xlsx');

    }
}
