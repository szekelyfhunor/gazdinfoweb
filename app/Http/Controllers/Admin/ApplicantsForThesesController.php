<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApplicantStatusMail;
use App\Models\Applicants;
use App\Models\DiplomaThesis;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplicantsForThesesController extends Controller
{
    public $applicants;

    public function index()
    {
        $teacher = Auth::user()->teacher; 

        $diplomaThesisIds = $teacher->diploma_theses()->pluck('id');

        $applicants = Applicants::whereHas('diplomaTheses', function ($query) use ($diplomaThesisIds) {
            $query->whereIn('id', $diplomaThesisIds);
        })->get();

        $diplomatheses = DiplomaThesis::all();
        $users = User::all();
        $students = Student::all();

        return view('dashboard.diplomaTheses.applicants', compact('applicants', 'diplomatheses', 'users', 'students'));
    }

    public function accept($id)
    {
        $applicant = Applicants::find($id);
        
        if (!$applicant) {
            session()->flash('error', 'Applicant not found.');
            return redirect()->back();
        }

        $applicant->accept();

        foreach ($applicant->diplomaTheses as $diplomaThesis) {
            $diplomaThesis->status = 'accepted';
            $diplomaThesis->save();
        }
        
        Mail::to('szekelyfhunor@uni.sapientia.ro')->send(new ApplicantStatusMail($applicant, 'accepted'));

        session()->flash('success', 'Visszajelzés elküldve.');

        return redirect()->back();
    }


    public function reject($id)
    {
        $applicant = Applicants::find($id);
        
        if (!$applicant) {
            session()->flash('error', 'Applicant not found.');
            return redirect()->back();
        }

        $applicant->reject();
        
        Mail::to('szekelyfhunor@uni.sapientia.ro')->send(new ApplicantStatusMail($applicant, 'rejected'));

        session()->flash('success', 'Visszajelzés elküldve.');

        return redirect()->back();
    }


}
