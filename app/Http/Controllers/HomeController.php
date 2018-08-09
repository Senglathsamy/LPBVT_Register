<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
use App\Subject;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $std = Student::query()->where('st_status', 1)->count();
        $teacher = Teacher::query()->count();
        $subject= Subject::query()->count();
        $users = User::query()->count();
        return view('home', ['std'=> $std, 'teacher' => $teacher, 'subject' => $subject, 'users' => $users]);
    }
}
