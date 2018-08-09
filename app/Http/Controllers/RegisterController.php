<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Register;
use App\Student;
use App\SubMajor;
use App\Department;
use App\Major;
use App\Degree;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class RegisterController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dept_id = $request->dept_id;
        $ma_id = $request->ma_id;
        $de_id = $request->de_id;
        $year = $request->studyyear;

            $student = Student::selectRaw('register.*, students.*, ifnull(max(register.rg_studyyear), 0) as current_year')
                        ->leftjoin('register', 'students.st_id', '=', 'register.st_id')
                        ->where('students.st_status', 0)
                        ->where('students.ma_id', $ma_id)
                        ->where('students.de_id', $de_id)
                        ->groupby('students.st_id')
                        ->having(DB::Raw('ifnull(max(register.rg_studyyear), 0)'), $year-1)
                        ->having(DB::Raw('ifnull(year(register.created_at), 0000)'), '<', date('Y'))
                        ->orderBy('students.st_id', 'asc')->get();
            return view('register.index', ['student' => $student])
                ->with('i', 0)
                ->withInput(['st_department'=>$dept_id, 'ma_id' => $ma_id, 'de_id' => $de_id, 'studyyear'=>$year]);
    }

    public function list(Request $request)
    {
        $dept_id = $request->dept_id;
        $ma_id = $request->ma_id;
        $de_id = $request->de_id;
        $year = $request->studyyear;
        $ac_year = $request->ac_year;
        
            $register = Register::selectRaw('students.*, register.*')
                        ->leftjoin('students', 'students.st_id', '=', 'register.st_id')
                        ->where('students.ma_id', $ma_id)
                        ->where('students.de_id', $de_id)
                        ->where('register.rg_studyyear', $year)
                        ->where('register.rg_academicyear', $ac_year)
                        ->groupby('students.st_id')
                        ->orderBy('register.rg_id', 'desc')->get();
                        //dd($register);
            return view('register.list', ['register' => $register])
                ->with('i', 0)
                ->withInput(['st_department'=>$dept_id, 'ma_id' => $ma_id, 'de_id' => $de_id, 'studyyear'=>$year]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $st_ids = $request->selectstudent;
        $year = $request->year;
        $ac_year = $request->academicyear;
        $ma_id = $request->ma_id;
        $de_id = $request->de_id;
        $dept_id = $request->dept_id;

        $department = Department::find($dept_id);
        $major = Major::find($ma_id);
        $degree = Degree::where('degree.id', $de_id)->leftjoin('courses', 'courses.id', '=', 'degree.course_id')
                ->selectRaw("CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') AS full_text")->first();
        $student = Student::find($st_ids);
            return view('register.create', ['student' => $student, 'year'=>$year, 'ac_year'=>$ac_year, 'department'=>$department->dept_name, 'major' => $major->ma_name, 'system' => $degree->full_text, 'dept_id'=>$dept_id, 'ma_id'=>$ma_id, 'de_id'=>$de_id])
                ->with('i', 0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $registerRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(RegisterRequest $registerRequest)
    {
        $register = new Register();

        $register->rg_paiddate = $registerRequest->paid_date;
        $register->rg_recieptno = $registerRequest->reciept_no;
        $register->rg_academicyear = $registerRequest->ac_year;
        $register->rg_studyyear = $registerRequest->year;
        $register->st_id = $registerRequest->st_id;

        $std = Student::find($registerRequest->st_id);
        $reg = Register::query()->where('st_id', $registerRequest->st_id)->where('rg_studyyear', $registerRequest->year)->get();
        $subject = SubMajor::query()->with('subject')
            ->where('year', $registerRequest->year)
            ->where('ma_id', $std->ma_id)
            ->where('de_id', $std->de_id)
            ->get();

        //Check it doesnt have course in study year
        if (count($subject) <= 0) {
            $registerRequest->session()->flash('statusW', 'ບໍ່ມີວິຊາຮຽນໃນປີ ' . $registerRequest->year .' !\n ກະລຸນາກວດສອບໃນຂໍ້ມູນຫລັດສູດ');
            return redirect($registerRequest->session()->get('_previous')['url']);
        }

        if (count($reg) <= 0) {

            $register->save();
            $reg_id = $register->rg_id;

            if ($registerRequest->toyear = 1) {
                $std->st_registerdate = $registerRequest->ac_year;
                $std->update();
            }
            
            foreach ($subject as $sj) {
 
                    $register->subjects()->attach($sj->subject->id, array("reg_id"=>$reg_id, 'term'=>$sj->term, "created_at"=> Carbon::now()));
            }

            $registerRequest->session()->flash('status', 'ລົງທະບຽນຮຽນສຳເລັດ!');
            return redirect($registerRequest->session()->get('_previous')['url']);
        }else{
            $registerRequest->session()
                    ->flash('statusW', $std->st_fname . ' ' . $std->st_lname . ' \nໄດ້ລົງທະບຽນຮຽນໃນປີ '. $registerRequest->year .' ແລ້ວ!');
            return redirect($registerRequest->session()->get('_previous')['url']);
        }//end check student has already register

    }//end function add

    public function storeMulti(RegisterRequest $registerRequest)
    {
        //dd($registerRequest);
        $subject = SubMajor::query()->with('subject')
                    ->where('year', $registerRequest->year)
                    ->where('ma_id', $registerRequest->ma_id)
                    ->where('de_id', $registerRequest->de_id)
                    ->get();
        if (count($subject) <= 0) {
            $registerRequest->session()->flash('statusW', 'ບໍ່ມີວິຊາຮຽນໃນປີ ' . $registerRequest->year .' !\n ກະລຸນາກວດສອບໃນຂໍ້ມູນຫລັດສູດ');
           return redirect($registerRequest->session()->get('_previous')['url']);
        }

        $insertRow = 0;
        foreach ($registerRequest->st_id as $st_id) {
            $register = new Register();
            $register->st_id = $st_id;
            $register->rg_paiddate = $registerRequest->paid_date[$st_id];
            $register->rg_recieptno = $registerRequest->reciept_no[$st_id];
            $register->rg_academicyear = $registerRequest->ac_year;
            $register->rg_studyyear = $registerRequest->year;

            $std = Student::find($st_id);
            $reg = Register::query()->where('st_id', $st_id)->where('rg_studyyear', $registerRequest->year)->get();

            if (count($reg) <= 0) {

                $register->save();
                $reg_id = $register->rg_id;
                if ($registerRequest->year = 1) {
                    $std->st_registerdate = $registerRequest->ac_year;
                    $std->update();
                }

                foreach ($subject as $sj) {

                    $register->subjects()->attach($sj->subject->id, array("reg_id"=>$reg_id, 'term'=>$sj->term, "created_at"=> Carbon::now()));
                }
                $insertRow++;
            }
        }

        if ($insertRow>0) {
            $registerRequest->session()->flash('status', 'ການລົງທະບຽນຮຽນສຳເລັດ!');
        } else {
            $registerRequest->session()->flash('statusW', 'ການລົງທະບຽນຮຽນບໍ່ສຳເລັດ!');
        }
        return redirect($registerRequest->session()->get('_previous')['url']);

    }//end function add


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
    public function edit(Request $request, $id)
    {
        $register = Register::find($id);
        return view('register.edit', compact('register'), ['ma_id' => $request->session()->get('ma_id')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RegisterRequest $registerRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(RegisterRequest $registerRequest, $id)
    {
        $register = Register::find($id);
        $register->update($registerRequest->all());
        $registerRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນລົງທະບຽນຮຽນສຳເລັດ!');
        return redirect($registerRequest->session()->get('_previous')['url']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $register = Register::find($id);
        $register->delete();
        session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        return back();
    }

    public function destroyMultiple(Request $request)
    {
        $register = Register::whereIn('rg_id', $request->reg_ids);
        $register->delete();
        session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        return back();
    }

    public static function getStudyYear($de_id) {
        $TotalYear = Degree::query()->where("id",$de_id)->pluck("total_year");
        $year = array();
        for ($i=1; $i <= $TotalYear->first(); $i++) {
            $year[$i] = $i;
        }
        return json_encode($year);
    }

    public static function getSystem($ma_id) {
        //system = degree
        $system = Degree::leftjoin('sub_major', 'sub_major.de_id', '=', 'degree.id')
                ->join('courses', 'degree.course_id', '=', 'courses.id')
                ->where('sub_major.ma_id', $ma_id)
                ->groupby('degree.id')
                ->selectRaw("degree.id, CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') AS full_text")
                ->pluck('full_text', 'id');
        return json_encode($system);
    }
}
