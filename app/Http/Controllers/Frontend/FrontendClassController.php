<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ItKlub;
use Illuminate\Http\Request;

class FrontendClassController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $classes = Classes::all()->where('is_finished','=','0');
        return view('frontend.classes.index', compact('classes'));
    }
}
