<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
use App\Subject;
use App\TeachScore;
use App\SubTeach;
use Auth;

class TeachScoreUpgradeController extends Controller
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
        if (empty(Auth::user()->te_id)) {
            return redirect()->action('HomeController@index');
        }else{

            $score_upgrade = [];

            if (!empty($request->year)) {

                $register = Register::query()
                    ->where('rg_studyyear', $request->year)
                    ->where('rg_academicyear', $request->academicyear)
                    ->get(['rg_id']);

                foreach ($register as $rg) {
                    $score_upgrade[] = TeachScore::query()
                        ->where('upg_id', '!=', null)
                        ->where('upg_id', '!=', "")
                        ->where('reg_id', $rg->rg_id)
                        ->where('te_id', Auth::user()->te_id)
                        ->where('subb_id', $request->subb_id)
                        ->with('subjects')
                        ->get();
                }

                return view('teach-score.upgrade', compact('score_upgrade'))->with('i', 0);

            }
//            else{
//                $score_upgrade = [];
//                $year = Register::query()->get(['rg_studyyear'])->first();
//                $academicyear = Register::query()->get(['rg_academicyear'])->first();
//                if ($year == "") {
//                    return view('teach-score.upgrade', compact('score_upgrade'))->with('i', 0);
//                }
//                $subb_id = SubTeach::where('te_id', Auth::user()->te_id)->get(['subb_id'])->first();
//                $register = Register::query()
//                    ->where('rg_studyyear', $year->rg_studyyear)
//                    ->where('rg_academicyear', $academicyear->rg_academicyear)
//                    ->get(['rg_id']);
//
//
//                foreach ($register as $rg) {
//                    $score_upgrade[] = TeachScore::query()
//                        ->where('upg_id', '!=', null)
//                        ->where('upg_id', '!=', "")
//                        ->where('reg_id', $rg->rg_id)
//                        ->where('te_id', Auth::user()->te_id)
//                        ->where('subb_id', $subb_id->subb_id)
//                        ->with('subjects')
//                        ->get();
//                }
//                return view('teach-score.upgrade', compact('score_upgrade'))->with('i', 0);
//            }
            return view('teach-score.upgrade', compact('score_upgrade'))->with('i', 0);
        }
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
     * @param Request $request
     * @param  int $id
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
        $score_upgrade = TeachScore::find($id);
        $score_upgrade->score_upgrade = $request->score_upgrade;
        $score_upgrade->update();
        $request->session()->flash('status', 'Update Score Success!');
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
