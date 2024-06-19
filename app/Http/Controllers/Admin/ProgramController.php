<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProgramRequest;
use App\Http\Requests\EditProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProgramController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $programs = Program::all();
        return view('dashboard.program.index', compact('programs'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.program.create');
    }

    /**
     * @param CreateProgramRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProgramRequest $request)
    {
        Program::create($request->validated());
        return redirect()->route('dashboard.programs.index');
    }


    /**
     * @param Program $program
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Program $program)
    {
        return view('dashboard.program.edit', compact('program'));
    }

    /**
     * @param EditProgramRequest $request
     * @param Program $program
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditProgramRequest $request, Program $program)
    {
        $program->update($request->validated());
        return redirect()->route('dashboard.programs.index');
    }

    /**
     * @param Program $program
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Program $program)
    {
        $program->delete();
        return redirect()->route('dashboard.programs.index');
    }


}
