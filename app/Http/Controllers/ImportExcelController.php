<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Register;
use App\SubMajor;
use Carbon\Carbon;

class ImportExcelController extends Controller
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Import Excel to Register and Add List Subject to Tech_Score
     * for Student Register
     */
    public function importExcelRegister(Request $request)
    {
        if($request->hasFile('import_file')){

            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){

                $insert = [];

                foreach ($data as $value) {

                    if (($value->date != null) && ($value->student != null) && ($value->studyyear != null)) {

                        $student = Student::query()->where('st_id', $value->student)->get();
                        $reg = Register::query()->where('st_id', $value->student)->where('rg_studyyear', $value->studyyear)->get();
                        if ((count($student) > 0) && (count($reg) <= 0)) {

                            $insert[] = [
                                'rg_date' => Carbon::parse($value->date)->format('Y-m-d'),
                                'rg_studyyear' => $value->studyyear,
                                'rg_classno' => $value->classno,
                                'rg_paiddate' => Carbon::parse($value->paiddate)->format('Y-m-d'),
                                'rg_recieptno' => $value->recieptno,
                                'rg_academicyear' => $value->academicyear,
                                'st_id' => $value->student,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ];

                            $std = Student::find($value->student);
                            $subject = SubMajor::query()->with('subject')
                                ->where('year', $value->studyyear)
                                ->where('ma_id', $std->ma_id)
                                ->where('de_id', $std->de_id)
                                ->get();

                            if (count($subject) > 0) {

                                $register = new Register();
                                $register->rg_date = Carbon::parse($value->date)->format('Y-m-d');
                                $register->rg_studyyear = $value->studyyear;
                                $register->rg_classno = $value->classno;
                                $register->rg_paiddate = Carbon::parse($value->paiddate)->format('Y-m-d');
                                $register->rg_recieptno = $value->recieptno;
                                $register->rg_academicyear = $value->academicyear;
                                $register->st_id = $value->student;
                                $register->save();

                                $reg = Register::query()->orderBy('rg_id', 'DESC')->first();
                                $reg_id = Register::find($reg->rg_id);

                                foreach ($subject as $sj) {
                                    $reg_id->subjects()->attach($sj->subject->id, array("reg_id"=>$reg->rg_id, "created_at"=> Carbon::now()));
                                }

                            }

                        }

                    }


                }

//                return $insert;
                if (empty($insert)) {
                    $request->session()->flash('statusW', 'Check Student.');
                    return redirect()->action('RegisterController@index');
                }
                $request->session()->flash('status', 'Insert Record successfully.');
                return redirect()->action('RegisterController@index');

            }
        }
        $request->session()->flash('statusW', 'Insert Record Error.');
        return back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Import Excel to Student
     */
    public function importExcelStudent(Request $request)
    {
        if($request->hasFile('import_file')){

            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){

                $insert = [];

                foreach ($data as $value) {

                    if ($value->StudentID != null) {

                        $std = Student::query()->where('st_id', $value->StudentID)->get();

                        if ($std->count() <= 0) {

                            $insert[] = [

                                'st_id' => $value->StudentID,
                                'st_fname' => $value->FirstName,
                                'st_lname' => $value->LastName,
                                'st_gender' => $value->Gender,
                                'st_bdate' => Carbon::parse($value->Birthday)->format('Y-m-d'),
                                'st_bvillage' => $value->BVillage,
                                'st_bdistrict' => $value->BDistrict,
                                'st_bprovince' => $value->BProvince,
                                'st_nationality' => $value->Nationality,
                                'st_region' => $value->Region,
                                'st_phone' => $value->Phone,
                                'st_pvillage' => $value->PVillage,
                                'st_pdistrict' => $value->PDistrict,
                                'st_pprovince' => $value->PProvince,
                                'gr_fname' => $value->GFirstName,
                                'gr_lname' => $value->glastname,
                                'gr_phone' => $value->GPhone,
                                'gr_gender' => $value->GGender,
                                'ma_id' => $value->Major,
                                'de_id' => $value->Degree,
                                'st_registerdate' => $value->RegisterYear,
                                'st_status' => 1,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ];

                        }


                    }

                }


//                return $insert;

                if(!empty($insert)){

                    Student::insert($insert);

                    $request->session()->flash('status', 'Insert Record successfully.');
                    return redirect()->action('StudentController@index');
                }else{
                    $request->session()->flash('statusW', 'Check Student ID!.\n Data has Already');
                    return redirect()->action('StudentController@index');
                }
            }
        }
        $request->session()->flash('statusW', 'Insert Record Error.');
        return back();
    }



}
