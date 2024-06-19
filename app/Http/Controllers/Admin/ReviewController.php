<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Routing\Controller;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\EditReviewRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reviews = Review::all();
        return view('dashboard.reviews.index', compact('reviews'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.reviews.create');
    }

    /**
     * @param CreateReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReviewRequest $request)
    {
        DB::beginTransaction();
        try {
            $review = Review::create($request->all());
            $file = $request->file('image');
            $review->addMedia($file)->toMediaCollection('review_image', 'reviews');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A vélemény létrehozása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.reviews.index');
    }

    /**
     * @param Review $review
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Review $review)
    {
        return view('dashboard.reviews.edit', compact('review'));
    }

    /**
     * @param EditReviewRequest $request
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditReviewRequest $request, Review $review)
    {
        DB::beginTransaction();
        try {
            $review->update($request->all());
            if($request->file('image') != null){
                $review->clearMediaCollection('review_image');
                $file = $request->file('image');
                $review->addMedia($file)->toMediaCollection('review_image', 'reviews');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az vélemény módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.reviews.index');
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Review $review)
    {

        $review->clearMediaCollection('review_image');
        $review->delete();

        return redirect()->route('dashboard.reviews.index');
    }
}
