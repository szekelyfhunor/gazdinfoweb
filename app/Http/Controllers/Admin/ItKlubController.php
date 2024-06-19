<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateItKlubRequest;
use App\Http\Requests\EditItKlubRequest;
use App\Models\ItKlub;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ItKlubController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $itklubs = ItKlub::all();
        return view('dashboard.itklub.index', compact('itklubs'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.itklub.create');
    }

    /**
     * @param CreateItKlubRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateItKlubRequest $request)
    {
        DB::beginTransaction();
        try {
            $itklub = ItKlub::create($request->validated());
            $file = $request->file('image');
            $itklub->addMedia($file)->toMediaCollection('itklub_image', 'itklubs');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az itklub létrehozása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.itklub.index');
    }

    /**
     * @param ItKlub $itklub
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ItKlub $itklub)
    {
        return view('dashboard.itklub.edit', compact('itklub'));
    }

    /**
     * @param EditItKlubRequest $request
     * @param ItKlub $itklub
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditItKlubRequest $request, ItKlub $itklub)
    {
        DB::beginTransaction();
        try {
            $itklub->update($request->validated());
            if($request->file('image') != null){
                $itklub->clearMediaCollection('itklub_image');
                $file = $request->file('image');
                $itklub->addMedia($file)->toMediaCollection('itklub_image', 'itklubs');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az itklub módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.itklub.index');
    }

    /**
     * @param ItKlub $itklub
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(ItKlub $itklub)
    {
        $itklub->clearMediaCollection('itklub_image');
        $itklub->delete();
        return redirect()->route('dashboard.itklub.index');
    }
}
