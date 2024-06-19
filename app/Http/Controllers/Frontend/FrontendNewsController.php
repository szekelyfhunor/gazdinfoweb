<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Sluggable\SlugOptions;

class FrontendNewsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = News::orderBy('date', 'DESC')->get();
        return view('frontend.news.index', compact('news'));
    }

    /**
     * @param News $new
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(News $new)
    {
        return view('frontend.news.show', compact('new'));
    }
}
