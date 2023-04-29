<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result['totalusers'] = User::get()->count();
        $result['totalbatchs'] = Batch::get()->count();
        $result['totalcourse'] = Course::get()->count();
        $result['totalstudents'] = Student::get()->count();
        $result['courses'] = Course::orderBy('id', 'desc')->with('batch')->limit(5)->get();
        return view('home')->with($result);
    }

    public function studentsList(){
        return view('students.students-list');
    }

    public function adminProfile(){
        $userid = Auth::id();
        $result['user'] = User::where(['id' => $userid, 'is_admin' => 'admin'])->first();
        return view('profile')->with($result);
    }
}
