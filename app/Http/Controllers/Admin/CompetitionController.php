<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CreateCompetitionRequest;
use App\Http\Requests\EditCompetitionRequest;
use App\Models\Competition;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TypeOfParticipation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CompetitionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $competitions = Competition::all();
        $users = User::all();
        return view('dashboard.competitions.index', compact('competitions', 'users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $typeofparticipations = TypeOfParticipation::all();
        return view('dashboard.competitions.create', compact('students', 'teachers', 'typeofparticipations'));
    }

    /**
     * @param CreateCompetitionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCompetitionRequest $request)
    {
        DB::beginTransaction();

        try {
            $teacher_user_id = $request->input('teacher_id');
            $student_user_id = $request->input('student_id');
            request()->request->remove('teacher_user_id');
            request()->request->remove('student_user_id');
            $competition = Competition::create($request->all());
            $competition->teachers()->attach($teacher_user_id);
            $competition->students()->attach($student_user_id);
            if($request->file('availability') != null){
                $file = $request->file('availability');
                $competition->addMedia($file)->toMediaCollection('comp_availability', 'competitions');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az verseny létrehozása sikertelen volt!');
        }
        DB::commit();

        return redirect()->route('dashboard.competitions.index');
    }


    /**
     * @param Competition $competition
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Competition $competition)
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $typeofparticipations = TypeOfParticipation::all();
        return view('dashboard.competitions.edit', compact('competition', 'students', 'teachers', 'typeofparticipations'));
    }

    /**
     * @param EditCompetitionRequest $request
     * @param Competition $competition
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditCompetitionRequest $request, Competition $competition)
    {
        DB::beginTransaction();

        try {
            $competition->teachers()->detach();
            $competition->students()->detach();
            $teacher_user_id = $request->input('teacher_id');
            $student_user_id = $request->input('student_id');
            $competition->update($request->validated());
            $competition->teachers()->attach($teacher_user_id);
            $competition->students()->attach($student_user_id);
            if($request->file('availability') != null){
                $competition->clearMediaCollection('comp_availability');
                File::deleteDirectory(storage_path('app/public/competitions/competition_' . $competition->id/*.'_'.$competition->title*/));
                $file = $request->file('availability');
                $competition->addMedia($file)->toMediaCollection('comp_availability', 'competitions');
            }else if($request->has('file_cb')){
                $competition->clearMediaCollection('comp_availability');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az verseny módósítása sikertelen volt!');
        }
        DB::commit();

        return redirect()->route('dashboard.competitions.index');
    }

    /**
     * @param Competition $competition
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Competition $competition)
    {
        $competition->clearMediaCollection('comp_availability');
        File::deleteDirectory(storage_path('app/public/competitions/competition_' . $competition->id/*.'_'.$competition->title*/));
        $competition->delete();
        return redirect()->route('dashboard.competitions.index');
    }
}
