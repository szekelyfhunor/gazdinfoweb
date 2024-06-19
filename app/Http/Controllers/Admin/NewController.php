<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNewRequest;
use App\Http\Requests\EditNewRequest;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class NewController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = News::all();
        return view('dashboard.news.index', compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.news.create');
    }

    /**
     * @param CreateNewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateNewRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->request->add(['user_id' => Auth::id()]);
            $request->input('date') ?? $request->request->add(['date' => Carbon::now()->format('Y-m-d H:i:s')]);
            if($request->file('image') != null){
                $new = News::create($request->all());
                $file = $request->file('image');
                $new->addMedia($file)->toMediaCollection('new_image', 'news');
            }else{
                News::create($request->all());
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az hír létrehozása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.news.index');
    }


    /**
     * @param News $new
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(News $new)
    {
        return view('dashboard.news.edit', compact('new'));
    }

    /**
     * @param EditNewRequest $request
     * @param News $new
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditNewRequest $request, News $new)
    {
        DB::beginTransaction();
        try {
            $new->update($request->all());
            $request->request->add(['user_id' => Auth::id()]);
            $request->input('date') ?? $request->request->add(['date' => Carbon::now()->format('Y-m-d H:i:s')]);
            if($request->file('image') != null){
                $new->clearMediaCollection('new_image');
                $file = $request->file('image');
                $new->addMedia($file)->toMediaCollection('new_image', 'news');
            }else if($request->has('image_cb')){
                $new->clearMediaCollection('new_image');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az hír módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.news.index');
    }

    /**
     * @param News $new
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(News $new)
    {
        $new->clearMediaCollection('new_image');
        $new->delete();
        return redirect()->route('dashboard.news.index');
    }
}
