<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class FrontendStudentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $students = Student::where('year_of_finish', '<>', null)->get();
        $classes = Classes::where('is_finished', '=', '1')->orderBy('year', 'DESC')->get();
        return view('frontend.students.index', compact('students', 'classes'));
    }
}
