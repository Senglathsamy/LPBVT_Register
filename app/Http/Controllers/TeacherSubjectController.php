<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherSubjectRequest;
use App\Subject;
use App\SubTeach;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
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
    public function index()
    {
       $teacher_subject = Subject::with('teacher')->get();
        return view('teacher-subject.index', compact('teacher_subject'))->with('i', 0);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher-subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherSubjectRequest $teacherSubjectRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(TeacherSubjectRequest $teacherSubjectRequest)
    {

        $sub = $teacherSubjectRequest->subb_id;
        $subject = Subject::find($sub);
        $teach = $teacherSubjectRequest->te_id;

        foreach ($teach as $teachs) {
            $data = SubTeach::query()
                ->where('te_id', $teachs)
                ->where('subb_id', $sub)
                ->get();
            if (count($data) <= 0) {
                $subject->teacher()->attach($teachs);
            }
        }

        $teacherSubjectRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('TeacherSubjectController@index');

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
//        $sub_teach = SubTeach::query()->with('subject')->with('teacher')->where('subb_id', $id)->get();
        $teacher_subject = Subject::with('teacher')
            ->where('id', $id)
            ->get();
        foreach ($teacher_subject as $t_s) {
            return view('teacher-subject.edit', compact('t_s'));
        }
//        return view('teacher-subject.edit', compact('teacher_subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherSubjectRequest $teacherSubjectRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(TeacherSubjectRequest $teacherSubjectRequest, $id)
    {

//        $teacher_subject = Subject::with('teacher')->where('id', $id)->get();
//        return $teacher_subject;

        $subject = Subject::find($id);
        $teach = $teacherSubjectRequest->teacher;
        $subject->teacher()->sync($teach);
        $teacherSubjectRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('TeacherSubjectController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /******
            $data = SubTeach::query()->where('subb_id', $id)->get();
            foreach ($data as $da) {
                $sub_teach = SubTeach::find($da->id);
                $sub_teach->delete();
            }
        ******/

        $subject = Subject::find($id);
        $subject->teacher()->detach();
        session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('TeacherSubjectController@index');

    }

    public function getTeacherByDept($id)
    {
        $teacher = Teacher::selectRaw("CONCAT(te_init,' ', te_firstname,' ', te_lastname) AS full_name, id")
                    ->where('dept_id', $id)
                    ->pluck('full_text', 'id');
        return json_encode($system);
    }
}
