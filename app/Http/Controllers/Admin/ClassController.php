<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\EditClassRequest;
use App\Models\Classes;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ClassController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $classes = Classes::all();
        return view('dashboard.classes.index', compact('classes'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.classes.create');
    }

    /**
     * @param CreateClassRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateClassRequest $request)
    {
        DB::beginTransaction();
        $class = Classes::create($request->validated());

        try {
            if($request->file('academic_calendar') != null){
                $academic_calendar = $request->file('academic_calendar');
                $class->addMedia($academic_calendar)->toMediaCollection('academic_calendar', 'classes');
            }
            if($request->file('curriculum') != null){
                $curriculum = $request->file('curriculum');
                $class->addMedia($curriculum)->toMediaCollection('curriculum', 'classes');
            }
            if($request->file('timetable') != null){
                $timetable = $request->file('timetable');
                $class->addMedia($timetable)->toMediaCollection('timetable', 'classes');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az évfolyam létrehozása sikertelen volt!');
        }

        DB::commit();

        return redirect()->route('dashboard.classes.index');
    }

    /**
     * @param Classes $class
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Classes $class)
    {
        return view('dashboard.classes.edit', compact('class'));
    }

    /**
     * @param EditClassRequest $request
     * @param Classes $class
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditClassRequest $request, Classes $class)
    {
        DB::beginTransaction();
        $class->update($request->validated());

        try {
            if($request->file('academic_calendar') != null){
                $class->clearMediaCollection('academic_calendar');
                $academic_calendar = $request->file('academic_calendar');
                $class->addMedia($academic_calendar)->toMediaCollection('academic_calendar', 'classes');
            }else if($request->has('academic_calendar_cb')){
                $class->clearMediaCollection('academic_calendar');
            }
            if($request->file('curriculum') != null){
                $class->clearMediaCollection('curriculum');
                $curriculum = $request->file('curriculum');
                $class->addMedia($curriculum)->toMediaCollection('curriculum', 'classes');
            }else if($request->has('curriculum_cb')){
                $class->clearMediaCollection('curriculum');
            }
            if($request->file('timetable') != null){
                $class->clearMediaCollection('timetable');
                $timetable = $request->file('timetable');
                $class->addMedia($timetable)->toMediaCollection('timetable', 'classes');
            }else if($request->has('timetable_cb')){
                $class->clearMediaCollection('timetable');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az évfolyam módosítása sikertelen volt!');
        }
        DB::commit();

        return redirect()->route('dashboard.classes.index');
    }

    /**
     * @param Classes $class
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Classes $class)
    {
        $class->clearMediaCollection('academic_calendar');
        $class->clearMediaCollection('curriculum');
        $class->clearMediaCollection('timetable');
        File::deleteDirectory(storage_path('app/public/classes/class_' . $class->id));

        $class->delete();
        return redirect()->route('dashboard.classes.index');
    }
}
