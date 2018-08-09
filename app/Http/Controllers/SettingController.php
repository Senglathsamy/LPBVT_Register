<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Register;
use App\Student;
use App\Teacher;
use App\TeachScore;
use App\Major;
use App\Degree;
use App\Upgrade;
use App\District;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class SettingController extends Controller
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
        
            return view('setting.index')
                ->with('i', 0);
    }

    
    
}
