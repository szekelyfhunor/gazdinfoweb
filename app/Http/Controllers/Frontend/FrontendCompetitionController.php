<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\TypeOfParticipation;
use Illuminate\Http\Request;

class FrontendCompetitionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $allTypeofparticipations = TypeOfParticipation::all();
        $typeofparticipations = $allTypeofparticipations->reject(function ($typeofparticipation, $key) {
            return !($typeofparticipation->competition);
        });
        $competitions = Competition::orderBy('date', 'DESC')->get();

        return view('frontend.competitions.index', compact('typeofparticipations', 'competitions'));
    }
}
