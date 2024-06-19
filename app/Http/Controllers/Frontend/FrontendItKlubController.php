<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItKlub;
use App\Models\News;
use Illuminate\Http\Request;

class FrontendItKlubController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $itklubs = ItKlub::all();
        return view('frontend.itklub.index', compact('itklubs'));
    }
}
