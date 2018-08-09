<?php

namespace App\Http\Controllers;

use Auth;
use App\Register;
use App\Subject;
use App\SubTeach;
use App\TeachScore;
use App\Teacher;
use App\Student;
use App\ClassRoom;
use Illuminate\Http\Request;

class TeachScoreController extends Controller
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
        /*if (empty(Auth::user()->te_id)) {
            return redirect()->action('HomeController@index');
        }*/
        $ac_option[] = '--ສົກຮຽນປີ--';
        $Y = date('Y');
        $m = date('m');
        $y2 = ($m>7)?$Y+1:$Y;
        for($i=0; $i<10; $i++) {
            $acy = ($y2-1).'-'.$y2;
            $ac_option[$acy] = $acy;
            $y2--;
        }

        $classes = ClassRoom::selectRaw("classroom.*, (select count(*) as member from register where rg_classno=classroom.cr_id) as member, CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') as system")
                    ->leftjoin('degree', 'degree.id', '=', 'classroom.de_id')
                    ->join('courses', 'degree.course_id', '=', 'courses.id')
                    ->where('ma_id', $request->ma_id);
            if (@$request->ac_year) {
                $classes = $classes->where('cr_ac_year', $request->ac_year);
            }
            $classes = $classes->orderBy('system', 'desc')
                    ->orderBy('classroom.cr_year', 'desc')
                    ->get();
        return view('teach-score.index', ['classes'=>$classes, 'ac_option'=>$ac_option])->with('i', 0);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function classlist($id)
    {
        //
        $class = ClassRoom::find($id);
        $teachSubjects = TeachScore::selectRaw('subjects.*, teachers.*, teachers.id as te_id, teach_score.*')
                    ->join('register', 'register.rg_id', '=', 'teach_score.reg_id')
                    ->leftjoin('subjects', 'subjects.id', '=', 'teach_score.subb_id')
                    ->leftjoin('teachers', 'teachers.id', '=', 'teach_score.te_id')
                    ->where('register.rg_classno', $class->cr_id)
                    ->groupby('teach_score.subb_id')
                    ->orderby('teach_score.term')
                    ->get();

                    // dd($teachSubjects);

        return view('teach-score.class', ['teachSubjects'=>$teachSubjects, 'class'=>$class])->with('i', 0);
    }

    public function score($cid, $sid)
    {
        //
        $class = ClassRoom::find($cid);
        $studentScore = Register::selectRaw("*, CONCAT(if(students.st_gender='ຊາຍ', 'ທ.', 'ນ.'),' ', students.st_fname,' ', students.st_lname) as full_name, (select ug_score from upgrade where teachscore_id=teach_score.id order by updated_at desc limit 1) as score_upgraded")
                    ->leftjoin('students', 'register.st_id', '=', 'students.st_id')
                    ->leftjoin('teach_score', 'register.rg_id', '=', 'teach_score.reg_id')
                    ->where('register.rg_classno', $cid)
                    ->where('teach_score.subb_id', $sid)
                    ->orderby('students.st_gender')
                    ->orderby('students.st_id')
                    ->get();
                    // dd($studentScore);

        return view('teach-score.score', ['studentScore'=>$studentScore, 'class'=>$class])->with('i', 0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        // dd($request->score);
        foreach ($request->score as $id=>$score) {
            $score = TeachScore::find($id)->update(['score_real'=>$score]);
        }
        $request->session()->flash('status', 'ຂໍ້ມູນຖຶກແກ້ໄຂແລ້ວ!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
