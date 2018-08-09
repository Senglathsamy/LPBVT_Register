<?php

namespace App\Http\Controllers;

use App\Major;
use App\Degree;
use App\Register;
use App\Student;
use App\TeachScore;
use App\Teacher;
use App\ClassRoom;
use App\ClassSubjects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ManageClassController extends Controller
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
        $classes = ClassRoom::selectRaw("classroom.*, (select count(*) as member from register where rg_classno=classroom.cr_id) as member, CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') as system")
                    ->leftjoin('degree', 'degree.id', '=', 'classroom.de_id')
                    ->join('courses', 'degree.course_id', '=', 'courses.id')
                    ->where('ma_id', $request->ma_id)
                    ->where('cr_ac_year', $request->ac_year)
                    ->orderBy('system', 'desc')
                    ->orderBy('classroom.cr_year', 'desc')
                    ->get();

        $Y = date('Y');
        $m = date('m');
        $y2 = ($m>7)?$Y+1:$Y;
        $ac_option[] = '--ສົກຮຽນປີ--';
        for($i=0; $i<10; $i++) {
            $acy = ($y2-1).'-'.$y2;
            $ac_option[$acy] = $acy;
            $y2--;
        }

        return view('manage-class.index', ['classes'=>$classes, 'ac_option'=>$ac_option])->with('i', 0)
                ->withInput(['department'=>$request->department, 'ma_id'=>$request->ma_id, 'de_id'=>$request->de_id, 'ac_year'=>$request->ac_year]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('manage-class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class = New ClassRoom();
        $class->cr_name = $request->cr_name;
        $class->cr_ac_year = $request->cr_ac_year;
        $class->cr_year = $request->studyyear;
        $class->ma_id = $request->ma_id;
        $class->de_id = $request->de_id;

        $class->save();
        $request->session()->flash('status', 'ສ້າງຫ້ອງຮຽນສຳເລັດ!');
        return redirect()
            ->action('ManageClassController@index', 'department='.$request->department.'&ma_id='.$request->ma_id. '&de_id='.$request->de_id)
            ->withInput(['department' => $request->department, 'ma_id'=>$request->ma_id, 'de_id'=>$request->de_id]);

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

    public function enroll(Request $request, $id)
    {
        $data = null;
        $class = ClassRoom::find($id);
        $degree = Degree::selectRaw("CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') AS full_degree")
                ->join('courses', 'courses.id', '=', 'degree.course_id')->where('degree.id', $class->de_id)->first();
        $major = Major::find($class->ma_id);
        $class->full_degree = $degree->full_degree . ', '. $major->ma_name . ', ' . $major->department->dept_name;
        if (@$request->tab==1) {
            $t1_enroll = TeachScore::selectRaw('subjects.*, teachers.*, teach_score.*')
                    ->join('register', 'register.rg_id', '=', 'teach_score.reg_id')
                    ->leftjoin('subjects', 'subjects.id', '=', 'teach_score.subb_id')
                    ->leftjoin('teachers', 'teachers.id', '=', 'teach_score.te_id')
                    ->where('register.rg_classno', $class->cr_id)
                    ->where('teach_score.term', 1)
                    ->groupby('teach_score.subb_id')
                    ->orderby('teach_score.term')
                    ->get();
            $t2_enroll = TeachScore::selectRaw('subjects.*, teachers.*, teach_score.*')
                    ->join('register', 'register.rg_id', '=', 'teach_score.reg_id')
                    ->leftjoin('subjects', 'subjects.id', '=', 'teach_score.subb_id')
                    ->leftjoin('teachers', 'teachers.id', '=', 'teach_score.te_id')
                    ->where('register.rg_classno', $class->cr_id)
                    ->where('teach_score.term', 2)
                    ->groupby('teach_score.subb_id')
                    ->orderby('teach_score.term')
                    ->get();

            $data = array('t1_enroll'=>$t1_enroll, 't2_enroll'=>$t2_enroll, 'class'=>$class);
        } else {
            $st_enroll = Register::selectRaw("register.*, students.*, CONCAT(if(students.st_gender='ຊາຍ', 'ທ.', 'ນ.'),' ', students.st_fname,' ', students.st_lname) as full_name")
                    ->leftjoin('students', 'register.st_id', '=', 'students.st_id')
                    ->where('students.ma_id', $class->ma_id)
                    ->where('students.de_id', $class->de_id)
                    ->where('register.rg_academicyear', $class->cr_ac_year)
                    ->where('register.rg_studyyear', $class->cr_year)
                    ->where('register.rg_classno', null)
                    ->orderBy('students.st_id')->get();
            $st_enrolled = Register::selectRaw("register.*, students.*, CONCAT(if(students.st_gender='ຊາຍ', 'ທ.', 'ນ.'),' ', students.st_fname,' ', students.st_lname) as full_name")
                    ->leftjoin('students', 'register.st_id', '=', 'students.st_id')
                    ->where('students.ma_id', $class->ma_id)
                    ->where('students.de_id', $class->de_id)
                    ->where('register.rg_academicyear', $class->cr_ac_year)
                    ->where('register.rg_studyyear', $class->cr_year)
                    ->where('register.rg_classno', $id)
                    ->orderBy('students.st_id')->get();
            $data = array('st_enroll'=>$st_enroll, 'st_enrolled'=>$st_enrolled, 'class'=>$class);
        }

         return view('manage-class.enroll', $data)
                ->with('i', 0);
    }

    public function updateTeach(Request $request)
    {
        $rg_ids = Register::where('rg_classno', $request->class_id)->pluck('rg_id')->toArray();

        $teachscore = TeachScore::query()
                    ->whereIn('teach_score.reg_id', $rg_ids)
                    ->where('teach_score.subb_id', $request->subb_id)
                    ;

        $teachscore->update(['te_id'=>$request->teacher]);

        $request->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາສຳເລັດ!');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enrollEdit(Request $request, $id)
    {

        $register = Register::whereIn('rg_id', $request->rg_id);
        $te_subj = Register::join('classroom', 'classroom.cr_id', '=', 'register.rg_classno')
                    ->join('teach_score', 'teach_score.reg_id', '=', 'register.rg_id')
                    ->whereNotNull('teach_score.te_id')
                    ->where('teach_score.te_id', '<>', 0)
                    ->where('register.rg_classno', $id)
                    ->groupBy('teach_score.subb_id')
                    ->pluck('te_id', 'subb_id')->toArray();

        if($request->action=='add' ) {
            $register->update(['rg_classno'=>$id]);
            ClassSubjects::where('cr_id', $id)->delete();

            // The part help if this registration done after teacher-subject update in class room
            if (count($te_subj)>0) {

                foreach($request->rg_id as $rg_id){ 
                    $cases = [];
                    $subb_ids = [];
                    foreach($te_subj as $subb_id=>$te_id) {
                        $cases[] = "WHEN subb_id='{$subb_id}' then '{$te_id}'";
                        $subb_ids[] = "'{$subb_id}'";
                    }
                    $cases = implode(' ', $cases);
                    $subb_ids = implode(', ', $subb_ids);

                    DB::update(DB::raw("UPDATE teach_score SET te_id=(CASE {$cases} END), updated_at = '".Carbon::now()."' WHERE subb_id in ({$subb_ids}) and reg_id={$rg_id}"));
                }
            }
        } else {
            $chk = Register::where('rg_classno', $id)->count();
            if ($chk<=$register->count())
            {
                $data = array();
                foreach($te_subj as $subb_id=>$te_id) {
                    $data[] =[ 'cr_id'=>$id, 'subb_id'=>$subb_id, 'te_id'=>$te_id];
                }
                ClassSubjects::insert($data);
            }
            $register->update(['rg_classno'=>null]);
        } 
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $class = ClassRoom::find($request->cr_id);
        $class->cr_name = $request->cr_name;
        //dd($class);
        $class->update();

        $request->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນຫ້ອງຮຽນສຳເລັດ!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_member = Register::where('rg_classno', $id)->count();
        if($class_member<=0) {
            ClassRoom::find($id)->delete();
            ClassSubjects::where('cr_id', $id)->delete();
            session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        } else {
            session()->flash('statusW',  'ບໍ່ສາມາດລົບຫ້ອງນີ້ໄດ້!\nຫ້ອງນີ້ຍັງມີນັກຮຽນຢູ່');
        }
        
        return back();
    }

    public function getTeacher($id)
    {
        $teacher = Teacher::selectRaw("CONCAT(te_init,' ', te_firstname,' ', te_lastname) AS full_name, teachers.id")
                    ->join('sub_teach', 'sub_teach.te_id', '=', 'teachers.id')
                    ->where('sub_teach.subb_id', $id)
                    ->pluck('full_name', 'id');
        return json_encode($teacher);
    }
}
