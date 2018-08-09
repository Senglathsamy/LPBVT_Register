<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Register;
use App\Student;
use App\Teacher;
use App\TeachScore;
use App\Major;
use App\Degree;
use App\Upgrade;
use App\District;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class StudentController extends Controller
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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$student = Student::query()->orderBy('st_id', 'desc')->get();

        $all = $request->all; //data search all
        $dept_id = $request->department;
        $ma_id = $request->ma_id;
        $de_id = $request->de_id;

            $student = Student::query();
            if(!empty($dept_id)) {
                $student = $student->whereIn('ma_id', Major::where('dept_id', $dept_id)->pluck('id')->toArray());
            }
            if(!empty($ma_id)) {
                $student = $student->where('ma_id', $ma_id);
            }
            if(!empty($de_id)) {
                $student = $student->where('de_id', $de_id);
            }
            $student = $student->orderBy('st_id', 'asc')->get();
            return view('student.index', ['student' => $student])
                ->with('i', 0)
                ->withInput(['department'=>$dept_id, 'ma_id' => $ma_id, 'de_id' => $de_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest $studentRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(StudentRequest $studentRequest)
    {
        $student = new Student();
        $student->st_id = str_replace(' ','',$studentRequest->st_id); //do not space of String
        $student->st_fname = $studentRequest->st_fname;
        $student->st_lname = $studentRequest->st_lname;
        $student->st_fname_eng = $studentRequest->st_fname_eng;
        $student->st_lname_eng = $studentRequest->st_lname_eng;
        $student->st_gender = $studentRequest->st_gender;
        $student->st_bdate = $studentRequest->st_bdate;
        $student->st_bvillage = $studentRequest->st_bvillage;
        $student->st_bdistrict = $studentRequest->st_bdistrict;
        $student->st_nationality = $studentRequest->st_nationality;
        $student->st_region = $studentRequest->st_region;
        $student->st_phone = $studentRequest->st_phone;
        $student->st_pvillage = $studentRequest->st_pvillage;
        $student->st_pdistrict = $studentRequest->st_pdistrict;
        $student->gr_fname = $studentRequest->gr_fname;
        $student->gr_lname = $studentRequest->gr_lname;
        $student->gr_phone = $studentRequest->gr_phone;
        $student->gr_gender = $studentRequest->gr_gender;
        $student->ma_id = $studentRequest->ma_id;
        $student->de_id = $studentRequest->de_id;
        $student->st_registerdate = $studentRequest->st_registerdate;
        $student->st_status = 1;
        $student->save();
        $studentRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()
            ->action('StudentController@index', 'ma_id=' . $studentRequest->ma_id . '&de_id=' . $studentRequest->de_id)
            ->withInput(['ma_id' => $studentRequest->ma_id, 'de_id' => $studentRequest->de_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::selectRaw('students.*, if(register.rg_id, 1, 0) as xstudent')
                    ->leftjoin('register', 'students.st_id', '=', 'register.st_id')
                    ->where('students.st_id', $id)
                    ->first();
        return view('student.edit', ['student' => $student])
                ->with('i', 0);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest|StudentUpdateRequest $studentRequest
     * @param  int $id
     * @return \Illuminate\Http\Response--
     * @internal param Request $request
     */
   
    public function update(StudentRequest $studentRequest, $id)
    {
        $student = Student::find($id);
        $student->update($studentRequest->all());

        $studentRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('StudentController@index', $studentRequest->uri);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Delete all related data of given student from Upgrade table 
        Upgrade::whereIn('teachscore_id',TeachScore::whereIn('reg_id', Register::where('st_id', $id)->pluck('rg_id'))->pluck('id'))->delete();

        //Delete all related data of given student from teach_score table 
        TeachScore::whereIn('reg_id', Register::where('st_id', $id)->pluck('rg_id'))->delete();

        //Delete all related data of given student from register table 
        Register::where('st_id', $id)->delete();

        //Delete all related data of given student from student table 
        Student::find($id)->delete();
        session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        return back();
    }

    /**
     * @param $id
     * @return mixed
     * Export Student Information to PDF
     */
    public function printInfo($id)
    {

        $student = Student::query()->where('st_id', $id)->get();

        foreach ($student as $std) {
            $pdf = PDF::loadView('student.export-pdf', compact('std'));
            $date = Carbon::now();

            return $pdf->download($date.$std->st_id .'.pdf');
        }
    }
    
}
