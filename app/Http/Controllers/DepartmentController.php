<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;
use App\Major;
use App\Teacher;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $department = Department::all();
        return view('department.index', ['department' => $department])->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $departmentRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(DepartmentRequest $departmentRequest)
    {
        $department = new Department();
        $department->dept_name = $departmentRequest->dept_name;
        $department->save();
        $departmentRequest->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('DepartmentController@index');
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
        $department = Department::find($id);
        return view('department.edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $departmentRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update(DepartmentRequest $departmentRequest, $id)
    {
        $department = Department::find($id);
        $department->update($departmentRequest->all());
        $departmentRequest->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
        return redirect()->action('DepartmentController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $major = Major::query()->where('dept_id', $id)->count();
        $teacher = Teacher::query()->where('dept_id', $id)->count();
        //Check it In major table
        if ($major > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ສາຊາວິຊາ)');
            return back();
        }
        //Check it in teacher table
        elseif ($teacher > 0) {
            session()->flash('statusW', 'ບໍ່ສາມາດລົບຂໍ້ມູນນີ້ໄດ້!\nຂໍ້ມູນນີ້ມີການນຳໃຊ້ຢູ່ (ອາຈານສອນ)');
            return back();
        }else{
            $department = Department::find($id);
            $department->delete();
            session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
            return back();
        }

    }
}
