<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Applicants;
use App\Models\DiplomaThesis;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendApplicantsController extends Controller
{
    public function index()
    {
        $diplomaTheses = DiplomaThesis::all();
        $topics = Topic::all();
        $teachers = Teacher::all();
        $users = User::all();
        return view('frontend.applicants.index', compact('diplomaTheses', 'topics', 'teachers', 'users'));
    }

    public function apply(DiplomaThesis $thesis)
    {
        $diplomaThesis = DiplomaThesis::findOrFail($thesis->id);
        $topics = Topic::all();
        $teachers = Teacher::all();
        $users = User::all();
        $students = Student::all();
        return view('frontend.applicants.apply', compact('diplomaThesis', 'topics', 'teachers', 'users', 'students'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'notes' => 'required|string|max:255',
            'diploma_thesis_id' => 'required|exists:diploma_theses,id'
        ]);

        $applicant = new Applicants();
        $applicant->status = 'pending';
        $applicant->notes = $request->input('notes');
        $applicant->save();
        
        $applicant->student()->attach($request->input('student_id'));

        $applicant->diplomaTheses()->attach($request->input('diploma_thesis_id'));

        return view('frontend.applicants.application_success');

    }
    
}

