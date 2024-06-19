<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\EditSubjectRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard.subjects.index', compact('subjects'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.subjects.create');
    }

    /**
     * @param CreateSubjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSubjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $subject = Subject::create($request->all());
            $file = $request->file('image');
            $subject->addMedia($file)->toMediaCollection('subject_image', 'subjects');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A tantárgy létrehozása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.subjects.index');
    }

    /**
     * @param Subject $subject
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Subject $subject)
    {
        return view('dashboard.subjects.edit', compact('subject'));
    }

    /**
     * @param EditSubjectRequest $request
     * @param Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditSubjectRequest $request, Subject $subject)
    {
        DB::beginTransaction();
        try {
            $subject->update($request->all());
            if($request->file('image') != null) {
                $subject->clearMediaCollection('subject_image');
                $file = $request->file('image');
                $subject->addMedia($file)->toMediaCollection('subject_image', 'subjects');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A tanárgy módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.subjects.index');
    }

    /**
     * @param Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Subject $subject)
    {

        $subject->clearMediaCollection('subject_image');
        $subject->delete();

        return redirect()->route('dashboard.subjects.index');
    }
}
