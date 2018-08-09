<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorRequest;
use App\Major;
use App\Student;
use App\SubMajor;
use Illuminate\Http\Request;

class MajorController extends Controller
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
        $major = Major::all();
        return view('major.index', ['major' => $major])->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MajorRequest $majorRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(MajorRequest $majorRequest)
    {
        $major = new Major();
        $major->ma_name = $majorRequest->ma_name;
        $major->dept_id = $majorRequest->dept_id;
        $major->save();
        $majorRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('MajorController@index');
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
        $major = Major::find($id);
        return view('major.edit', ['major' => $major]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MajorRequest $majorRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(MajorRequest $majorRequest, $id)
    {
        $major = Major::find($id);
        $major->update($majorRequest->all());
        $majorRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('MajorController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = SubMajor::query()->where('ma_id', $id)->count();
        $student = Student::query()->where('ma_id', $id)->count();

        //Check id in Student
        if ($student > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ນັກສຶກສາ)');
            return back();
        }
        //Check In Course Or Sub Major
        elseif ($course > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ຫລັກສູດ)');
            return back();
        }
        else{
            $major = Major::find($id);
            $major->delete();
            session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
            return back();
        }

    }

    public function getMajorByDepartment($dept_id) {
        $major = Major::query()->where("dept_id",$dept_id)->pluck("ma_name","id");
        return json_encode($major);
    }

}
