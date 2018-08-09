<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Major;
use App\Student;
use App\Register;
use App\Upgrade;
use Illuminate\Http\Request;

class ReportController extends Controller
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

    public function studentReport(Request $request)
    {

        $year = $request->year;
        $classno = $request->classno;
        $academicyear = $request->academicyear;
        $ma_id = $request->ma_id;
        $student = [];
        $st = null;
        if (!empty($ma_id)) {

            $std = Student::query()->where('ma_id', $ma_id)->get(['st_id']);
            if (count($std) > 0) {
                if (!empty($academicyear) & !empty($year) & !empty($classno)) {
                    foreach ($std as $st) {
                        $student[] = Register::query()
                            ->where('rg_studyyear', $year)
                            ->where('rg_classno', $classno)
                            ->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
                }elseif (!empty($academicyear) & !empty($year) & empty($classno)) {
                    foreach ($std as $st) {
                        $student[] = Register::query()
                            ->where('rg_studyyear', $year)
                           // ->where('rg_classno', $classno)
                            ->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
                }elseif (!empty($academicyear) & empty($year) & !empty($classno)) {
                    foreach ($std as $st) {
                        $student[] = Register::query()
                            //->where('rg_studyyear', $year)
                            ->where('rg_classno', $classno)
                            ->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
                }elseif (!empty($academicyear) & empty($year) & empty($classno)) {
                    foreach ($std as $st) {
                        $student[] = Register::query()
                            //->where('rg_studyyear', $year)
                            //->where('rg_classno', $classno)
                            ->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
                }elseif (empty($academicyear) & !empty($year) & !empty($classno)) {
                    foreach ($std as $st) {
                        $student[] = Register::query()
                            ->where('rg_studyyear', $year)
                            ->where('rg_classno', $classno)
                            //->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
                }elseif (empty($academicyear) & empty($year) & !empty($classno)) {
                    foreach ($std as $st) {
                        $student[] = Register::query()
                            //->where('rg_studyyear', $year)
                            ->where('rg_classno', $classno)
                            //->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
			  	} else{
                    foreach ($std as $st) {
                        $student[] = Register::query()
                           // ->where('rg_studyyear', $year)
						   //->where('rg_classno', $classno)
                           // ->where('rg_academicyear', $academicyear)
                            ->where('st_id', $st->st_id)
                            ->get();
                    }
                }
				$st = 0;
				foreach ($student as $std) {
					foreach ($std as $v) {
					if(!empty($v)) {
						$st = 1;
						break 2;
					}
					}
				}
				
                return view('report.student-report', compact('student', 'st', 'ma_id', 'year', 'classno', 'academicyear'));

            }else{
                return view('report.student-report', compact('student', 'st', 'ma_id', 'year', 'classno', 'academicyear'));
            }
        }

        return view('report.student-report', compact('student', 'st', 'ma_id', 'year', 'classno', 'academicyear'));
    }

    public function registerReport(Request $request)
    {
        $year = $request->year;
        $academicyear = $request->academicyear;
        $register = [];

        if (!empty($academicyear)) {

            if (!empty($year)) {
                $register = Register::query()
                    ->where('rg_studyyear', $year)
                    ->where('rg_academicyear', $academicyear)
                    ->get();
            }else{
                $register = Register::query()
                    ->where('rg_academicyear', $academicyear)
                    ->get();
            }

        }
        return view('report.register-report', compact('register', 'academicyear', 'year'));
    }

    public function upgradeReport(Request $request)
    {
        $academicyear = $request->academicyear;
        $upgrade = [];
        $ug = 0;
        if (!empty($academicyear)) {
            $register = Register::query()
                ->where('rg_academicyear', $academicyear)
                ->get(['st_id']);

            if (count($register) > 0) {
                foreach ($register as $reg) {
                    $upgrade[] = Upgrade::query()->where('st_id', $reg->st_id)->get();
                }

            }else{
                return back();
            }

            foreach ($upgrade as $c) {
                $ug = count($c);
            }

            return view('report.upgrade-report', compact('upgrade', 'ug','academicyear'));
        }
        return view('report.upgrade-report', compact('upgrade', 'ug', 'academicyear'));
    }

    public function gradeReport(Request $request)
    {
        $year = $request->year;
        $classno = $request->classno;
        $academicyear = $request->academicyear;
        $ma_id = $request->ma_id;
        $grade = [];
        $st = [];

        return view('report.grade-report', compact('grade', 'year', 'classno', 'academicyear', 'ma_id', 'st'));
    }

    public function scoreReport()
    {
        return view('report.score-report');
    }


}
