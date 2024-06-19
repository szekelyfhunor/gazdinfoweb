<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePartnerRequest;
use App\Http\Requests\EditPartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $partners = Partner::all();
        return view('dashboard.partners.index', compact('partners'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.partners.create');
    }

    /**
     * @param CreatePartnerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePartnerRequest $request)
    {
        DB::beginTransaction();
        try {
            $partner = Partner::create($request->all());
            $file = $request->file('image');
            $partner->addMedia($file)->toMediaCollection('partner_image', 'partners');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A partner létrehozása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.partners.index');
    }

    /**
     * @param Partner $partner
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Partner $partner)
    {
        return view('dashboard.partners.edit', compact('partner'));
    }

    /**
     * @param EditPartnerRequest $request
     * @param Partner $partner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditPartnerRequest $request, Partner $partner)
    {
        DB::beginTransaction();
        try {
            $partner->update($request->all());
            if($request->file('image') != null){
                $partner->clearMediaCollection('partner_image');
                $file = $request->file('image');
                $partner->addMedia($file)->toMediaCollection('partner_image', 'partners');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A partner módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.partners.index');
    }

    /**
     * @param Partner $partner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Partner $partner)
    {

        $partner->clearMediaCollection('partner_image');
        $partner->delete();

        return redirect()->route('dashboard.partners.index');
    }
}
