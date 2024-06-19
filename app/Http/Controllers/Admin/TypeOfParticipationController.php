<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTypeOfParticipationtRequest;
use App\Http\Requests\EditTypeOfParticipationtRequest;
use App\Models\TypeOfParticipation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TypeOfParticipationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $typeofparticipations = TypeOfParticipation::all();
        return view('dashboard.typeOfParticipations.index', compact('typeofparticipations'));
    }

    /**
     * @param TypeOfParticipation $typeofparticipation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(TypeOfParticipation $typeofparticipation){
        $typeofparticipation->delete();
        return redirect()->route('dashboard.typeofparticipations.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.typeOfParticipations.create');
    }

    /**
     * @param CreateTypeOfParticipationtRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTypeOfParticipationtRequest $request)
    {
        TypeOfParticipation::create($request->validated());
        return redirect()->route('dashboard.typeofparticipations.index');
    }

    /**
     * @param TypeOfParticipation $typeofparticipation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TypeOfParticipation $typeofparticipation)
    {
        return view('dashboard.typeofparticipations.edit', compact('typeofparticipation'));
    }

    /**
     * @param EditTypeOfParticipationtRequest $request
     * @param TypeOfParticipation $typeofparticipation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditTypeOfParticipationtRequest $request, TypeOfParticipation $typeofparticipation)
    {
        $typeofparticipation->update($request->validated());
        return redirect()->route('dashboard.typeofparticipations.index');
    }
}
