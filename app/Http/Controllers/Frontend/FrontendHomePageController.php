<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Classes;
use App\Models\DiplomaThesis;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Review;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendHomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reviews = Review::all();
        $partners = Partner::all();
        $subjects = Subject::all();
        $programs = Program::all();
        return view('frontend.homepage.index', compact('reviews', 'partners', 'subjects', 'programs'));
    }
}
