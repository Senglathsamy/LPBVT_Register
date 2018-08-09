<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Subject;
use App\SubMajor;
use App\SubTeach;
use App\Teacher;
use App\TeachScore;
use App\Upgrade;
use Illuminate\Http\Request;

class SubjectController extends Controller
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

        $subject = Subject::all();
        return view('subject.index', ['subject' => $subject])->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubjectRequest $subjectRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(SubjectRequest $subjectRequest)
    {
        $subject = new Subject();
        $subject->sub_id = strtoupper($subjectRequest->sub_id);
        $subject->sub_name = $subjectRequest->sub_name;
        $subject->sub_credit = $subjectRequest->sub_credit; // nuay kit
        $subject->sub_unit1 = $subjectRequest->sub_unit1; // bun yaiy
        $subject->sub_unit2 = $subjectRequest->sub_unit2; // pa ti but
        $subject->sub_unit3 = $subjectRequest->sub_unit3; // thod long
        $subject->save();

        $subjectRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('SubjectController@index');
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
        $subject = Subject::find($id);
        return view('subject.edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubjectRequest $subjectRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(SubjectRequest $subjectRequest, $id)
    {
        $subject = Subject::find($id);
        $subject->update($subjectRequest->all());
        $subjectRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('SubjectController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //Check Data Usage Before delete
        $course = SubMajor::query()->where('subb_id', $id)->count();
        $score = TeachScore::query()->where('subb_id', $id)->count();

        //Check In Course Or Sub Major
        if ($course > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ຫລັກສູດ)');
            return back();
        }
        //Check In Score Or Teach Score
        elseif ($score > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ຄະແນນ)');
            return back();
        }else{
            $teach = SubTeach::query()->where('subb_id', $id);
            $teach->delete();
            $subject = Subject::find($id);
            $subject->delete();
            session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
            return back();
        }

    }
}
