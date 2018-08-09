<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Major;
use App\Subject;
use App\SubMajor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class MajorSubjectController extends Controller
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
        $sub_major = [];
        if (!empty($request->ma_id) && !empty($request->de_id)) {
                $sub_major = SubMajor::query()
                    ->where('ma_id', $request->ma_id)
                    ->where('de_id', $request->de_id)
                    ->orderBy('year', 'ASC')
                    ->orderBy('term', 'ASC')
                    ->get();
        }
        return view('major-subject.index', compact('sub_major'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('major-subject.create');
    }

    /**
     * Show the application selectAjax.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $subject = \DB::table('subjects')
                ->where('de_id', '!=', $request->de_id)->pluck("sub_name","id")->all();
            $data = view('major-subject.ajax-select',compact('subject'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year = $request->year;
        $term = $request->term;
        $major = $request->ma_id;
        $degree = $request->dde_id;
        $subject = $request->subb_id;
        $m = Major::find($major);

        foreach ($subject as $sub) {
            $search = SubMajor::query()
                ->where('ma_id', $major)
                ->where('subb_id', $sub)
                ->where('de_id', $degree)->get();

            if (count($search) <= 0) {
                $m->subject()->attach($sub, array("de_id"=>$degree, "year"=>$year, "term"=>$term, "created_at"=> Carbon::now()));
            }

        }

        $request->session()->flash('status', 'ເພີ່ມຂໍ້ມູນສຳເລັດ!');
        return redirect()
            ->action('MajorSubjectController@index', $request->uri)
            ->withInput([$request->uri])
            ;
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
        $sub_major = SubMajor::find($id);
        return view('major-subject.edit', compact('sub_major'));
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

        $data = SubMajor::query()
            ->where('ma_id', $request->ma_id)
            ->where('de_id', $request->dde_id)
            ->where('subb_id', $request->subb_id)
            ->get();

        if (count($data) > 0) {
            $subject = Subject::find($request->subb_id);
            $request->session()->flash('statusI', 'ວິຊາ\n\"' . $subject->sub_name . '\"\nມີໃນຫລັກສູດແລ້ວ!');
            return back();
        }else{
            $sub_major = SubMajor::find($id);
            $sub_major->update($request->all());

            $request->session()->flash('status', 'ແກ້ໄຂຂໍ້ມູນສຳເລັດ!');
            return redirect()
                ->action('MajorSubjectController@index', $request->uri);
            //    ->withInput(['ma_id' => $request->ma_id, 'de_id' => $request->de_id]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $major = Major::find($id);
//        $major->subject()->detach();

        //If Course is not change to next situation
        //Before delete data plz check in Teach Score Table or Model
        $sub_major = SubMajor::find($id);
        $sub_major->delete();
        session()->flash('status', 'ລົບຂໍ້ມູນສຳເລັດ!');
        return back();
    }
}
