<?php

namespace App\Http\Controllers;

use App\Department;
use App\Major;
use App\Register;
use App\Student;
use App\SubMajor;
use App\TeachScore;
use App\Upgrade;
use Illuminate\Http\Request;

class UpgradeController extends Controller
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
        $list_dept = Department::query()->get();
        //Check Dept
        if (count($list_dept) <= 0) {
            return back()->with('statusW', 'Don\'t have Department');
        }else{
            return view('upgrade.list_dept', compact('list_dept'));
        }
//        $upgrade = Upgrade::query()->orderBy('ug_id', 'DESC')->get();
//        return view('upgrade.index', compact('upgrade'))->with('i', 0);
    }

    public function deptSelect(Request $request, $id)
    {
        $request->session()->put('de_id', $id); //save session of department
        $list_major = Major::query()->where('dept_id', $id)->get();
        //Check Major
        if (count($list_major) <= 0) {
            return back()->with('statusW', 'Don\'t have Major');
        }else{
            return view('upgrade.list_major', compact('list_major'));
        }
    }

    public function majorSelect(Request $request, $id)
    {

//        $upgrade = [];
        $request->session()->put('ma_id', $id); //save session of major
        $std = Student::query()->where('ma_id', $id)->get(['st_id']);
        //Check Student in Major
        if (count($std) > 0) {
            foreach ($std as $s) {
                $upgrade[] = Upgrade::query()->with('student')->where('st_id', $s->st_id)->orderBy('ug_id', 'DESC')->get();
            }

//            return $upgrade;
            return view('upgrade.list_data', compact('upgrade'))->with('i', 0);
        }else{
            return back()->with('statusW', 'Don\'t have Student in Major');
        }
    }

    public function checkStudentRegister($ma_id)
    {
        return view('upgrade.beforeUpgrade', compact('ma_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $study_year = $request->ug_studyyear;
        $st_id = $request->st_id;
        $ma_id = $request->ma_id;
        $subb_id = $request->subb_id;
        $register = Register::query()->where('rg_studyyear', $study_year)->where('st_id', $st_id)->get();
        if (count($register) <= 0) {
            $request->session()->flash('statusW', 'Student doesn\'t have Register in Year');
            return back()->withInput(['ma_id' => $ma_id, 'ug_studyyear' => $study_year, 'st_id' => $st_id, 'subb_id' => $subb_id]);
        }else{
            foreach ($register as $res) {
                $rg_id = $res->rg_id;
                $teach_score = TeachScore::query()->where('reg_id', $rg_id)->where('subb_id', $subb_id)->get();
                if (count($teach_score) > 0) {
                    foreach ($teach_score as $ts) {
                        $id = $ts->id;
                        $score_real = $ts->score_real;
                        if ($score_real != null || $score_real != "") {
                            return view('upgrade.create', compact('st_id'), ['id' => $id,'score_real' => ($ts->score_upgrade == null || $ts->score_upgrade == '') ? $ts->score_real : $ts->score_upgrade, 'ma_id' => $ma_id, 'subb_id' => $subb_id]);
                        }else{
                            $request->session()->flash('statusW', 'This Subject doesn\'t have Score');
                            return back()->withInput(['ma_id' => $ma_id, 'ug_studyyear' => $study_year, 'st_id' => $st_id, 'subb_id' => $subb_id]);
                        }
                    }
                }else{
                    $request->session()->flash('statusW', 'Subject does\'t have in Year');
                    return back()->withInput(['ma_id' => $ma_id, 'ug_studyyear' => $study_year, 'st_id' => $st_id, 'subb_id' => $subb_id]);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $upgradeRequest
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(Request $upgradeRequest)
    {
        $id = $upgradeRequest->id;
        $ma_id = $upgradeRequest->ma_id;
        $subb_id = $upgradeRequest->subb_id;

        $upgrade = new Upgrade();
        $upgrade->ug_paiddate = $upgradeRequest->ug_paiddate;
        $upgrade->ug_recieptno = $upgradeRequest->ug_recieptno;
        $upgrade->st_id = $upgradeRequest->st_id;
        $upgrade->subj_id = $subb_id;
        $upgrade->save();

        $ug_id = Upgrade::query()->orderBy('ug_id', 'DESC')->get()->first();

        $teach_score = TeachScore::find($id);
        $teach_score->upg_id = $ug_id->ug_id;
        $teach_score->update();

        $upgradeRequest->session()->flash('status', 'Add Success!');
        return redirect()->action('UpgradeController@majorSelect', ['id' => $ma_id]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $upgrade = Upgrade::find($id);
//        $upgrade->delete();
//        return back();
    }
}
