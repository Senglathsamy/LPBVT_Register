<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\TeacherRequest;
use App\SubTeach;
use App\Teacher;
use App\TeachScore;
use App\User;
use App\Role;
use App\UserRole;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
        $teacher = Teacher::all();
        return view('teacher.index', ['teacher' => $teacher])->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $teacherRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(TeacherRequest $teacherRequest)
    {
        $teacher = new Teacher();
        $teacher->te_init = $teacherRequest->te_init;
        $teacher->te_firstname = $teacherRequest->te_firstname;
        $teacher->te_lastname = $teacherRequest->te_lastname;
        $teacher->te_bdate = $teacherRequest->te_bdate;
        $teacher->te_bvillage = $teacherRequest->te_bvillage;
        $teacher->te_bdistrict = $teacherRequest->bdistrict;
        $teacher->te_gender = $teacherRequest->te_gender;
        $teacher->te_nationality = $teacherRequest->te_nationality;
        $teacher->te_region = $teacherRequest->te_region;
        $teacher->te_phone = $teacherRequest->te_phone;
        $teacher->te_education = $teacherRequest->te_education;
        $teacher->te_major = $teacherRequest->te_major;
        $teacher->te_degree = $teacherRequest->te_degree;
        $teacher->startwork = $teacherRequest->startwork;
        $teacher->te_position = $teacherRequest->te_position;
        $teacher->te_party_position = $teacherRequest->te_party_position;
        $teacher->date_to_party1 = $teacherRequest->date_to_party1;
        $teacher->date_to_party2 = $teacherRequest->date_to_party2;
        $teacher->politic_level = $teacherRequest->politic_level; 
        $teacher->te_status = $teacherRequest->te_status; 
        //$teacher->te_photo = $teacherRequest->te_photo; 
        $teacher->dept_id = $teacherRequest->dept_id;
        $teacher->save();
        $teacherRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('TeacherController@index');
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
        $teacher = Teacher::find($id);
        $teacher->bdistrict = $teacher->te_bdistrict;
        return view('teacher.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherRequest $teacherRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(TeacherRequest $teacherRequest, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->update($teacherRequest->all());
        $teacherRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('TeacherController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //Before delete this teacher please check the data on relationship with other tables
        $score = TeachScore::query()->where('te_id', $id)->count();
        $teach = SubTeach::query()->where('te_id', $id)->count();

        //Check In Score Or Teach Score
        if ($score > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ຄະແນນ)');
            return back();
        }
        //Check In Sub Teach
        /*
        elseif ($teach > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ວິຊາສອນກັບ ອ.ຈ');
            return back();
        }
        */
        else{
            
            $users = User::query()->where('te_id', $id)->get();
            foreach($users as $user) {
                $role = UserRole::query()->where('user_id',$user->id)->delete();
            }
            User::query()->where('te_id', $id)->delete();
            $teacher = Teacher::find($id);
            $teacher->delete();
            session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
            return back();
        }

    }
}
