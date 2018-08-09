<?php

namespace App\Http\Controllers;

use App\Major;
use App\Register;
use App\Student;
use App\TeachScore;
use Illuminate\Http\Request;

class ManageTeacherScoreController extends Controller
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
        $reg = [];
        $manage_teach_score = [];
        $classno = $request->classno;
        $academicyear = $request->academicyear;
        $dept = null;

        if (!empty($request->year)) {

            $dept = Major::query()->where('id', $request->ma_id)->get(['dept_id'])->first();
            $std = Student::query()
                ->where('ma_id', $request->ma_id)
                ->get(['st_id']);

            foreach ($std as $st_id) {
                $reg[] = Register::query()
                    ->where('rg_studyyear',$request->year)
                    ->where('rg_classno',$request->classno)
                    ->where('rg_academicyear',$request->academicyear)
                    ->where('st_id',$st_id->st_id)
                    ->get(['rg_id']);
            }

            foreach ($reg as $rg) {
                foreach ($rg as $rg_id) {
                    $manage_teach_score[] = TeachScore::query()
                        ->with('subjects')
                        ->where('reg_id', $rg_id->rg_id)
                        ->get(['id', 'te_id', 'subb_id']);
                }
            }

            return view('manage-teacher-score.index', compact('manage_teach_score', 'classno', 'academicyear', 'dept'))->with('i', 0);
        }
//        else{
//            $reg = [];
//            $manage_teach_score = [];
//
//            $major = Major::query()->get()->first();
//            $register = Register::query()->get(['rg_classno', 'rg_academicyear'])->first();
//
//            $std = Student::query()
//                ->where('ma_id', $major->id)
//                ->get(['st_id']);
//
//            foreach ($std as $st_id) {
//                $reg[] = Register::query()
//                    ->where('rg_studyyear',1)
//                    ->where('rg_classno',$register->rg_classno)
//                    ->where('rg_academicyear',$register->rg_academicyear)
//                    ->where('st_id',$st_id->st_id)
//                    ->get(['rg_id']);
//            }
//
//            foreach ($reg as $rg) {
//                foreach ($rg as $rg_id) {
//                    $manage_teach_score[] = TeachScore::query()
//                        ->with('subjects')
//                        ->where('reg_id', $rg_id->rg_id)
//                        ->get(['id', 'te_id', 'subb_id']);
//                }
//            }
//
//            $classno = $register->rg_classno;
//            $academicyear = $register->rg_academicyear;
//
//            return view('manage-teacher-score.index', compact('manage_teach_score', 'classno', 'academicyear'))->with('i', 0);
//        }

        return view('manage-teacher-score.index', compact('manage_teach_score', 'classno', 'academicyear', 'dept'))->with('i', 0);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        $classno = $request->classno;
        $academicyear = $request->academicyear;
        $te_id = $request->te_id;

        $register = Register::query()
            ->where('rg_classno', $classno)
            ->where('rg_academicyear', $academicyear)
            ->get(['rg_id']);

        foreach ($register as $rg) {
         TeachScore::where('subb_id', '=', $id)
             ->where('reg_id', $rg->rg_id)
            ->update(['te_id' => $te_id]);
        }

//        TeachScore::where('subb_id', '=', $id)
//        ->update(['te_id' => $request->te_id]);
        $request->session()->flash('status', 'Choose Teacher to Subject Success!');
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
        //
    }
}
