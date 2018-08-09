<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Student;
use App\Http\Requests\DegreeRequest;
use App\SubMajor;
use DB;
use Illuminate\Http\Request;

class DegreeController extends Controller
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
        $degree = Degree::all();
        return view('degree.index', ['degree'=>$degree])->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('degree.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DegreeRequest $degreeRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(DegreeRequest $degreeRequest)
    {
        $degree = new Degree();
        $degree->degree = $degreeRequest->degree;
        $degree->course_id = $degreeRequest->course_id;
        $degree->program = $degreeRequest->program;
        $degree->save();
        $degreeRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('DegreeController@index');
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
        $degree = Degree::find($id);
        return view('degree.edit', compact('degree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DegreeRequest $degreeRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(DegreeRequest $degreeRequest, $id)
    {
        $degree = Degree::find($id);
        $degree->update($degreeRequest->all());
        $degreeRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('DegreeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = SubMajor::query()->where('de_id', $id)->count();
        $std = Student::query()->where('de_id', $id)->count();
        $class = ClassRoom::query()->where('de_id', $id)->count();
        if ($std > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ນັກສຶກສາ)');
            return back();
        }
        if ($class > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ຫ້ອງຮຽນ)');
            return back();
        }
        //Check In Course Or Sub Major
        elseif ($course > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ຫລັກສູດ)');
            return back();
        }
        
        $degree = Degree::find($id);
        $degree->delete();
        session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        return back();

    }

}
