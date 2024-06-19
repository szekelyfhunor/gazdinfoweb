<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateDiplomaThesisRequest;
use App\Http\Requests\EditDiplomaThesisRequest;
use App\Models\Applicants;
use App\Models\DiplomaThesis;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DiplomaThesisController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $diplomatheses = $teacher->diploma_theses()->with(['student', 'topics', 'teacher'])->get();

        $acceptedApplicants = Applicants::where('status', 'accepted')->get();
        $users = User::all();
        $topics = Topic::all();
        $pendingApplicantsCount = Applicants::where('status', 'pending')->count();

        return view('dashboard.diplomatheses.index', compact('acceptedApplicants', 'diplomatheses', 'users', 'topics', 'pendingApplicantsCount'));
    }


    public function create()
    {
        $students = Student::all();
        $teacher = Auth::user()->teacher;
        $topics = Topic::all();
        
        return view('dashboard.diplomaTheses.create', compact('students', 'teacher', 'topics'));
    }

    
    public function store(CreateDiplomaThesisRequest $request)
    {
        DB::beginTransaction();
        try {
            $diplomathese = new DiplomaThesis();
            $diplomathese->title = $request->input('title');
            $diplomathese->abstract = $request->input('abstract');
            $diplomathese->status = "pending";

            $diplomathese->save();

            $diplomathese->topics()->attach($request->input('topic_id'));
            $diplomathese->teacher()->attach($request->input('teacher_id'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A diplomadolgozat létrehozása sikertelen volt!');
        }

        return redirect()->route('dashboard.diplomatheses.index');
    }




    /**
     * @param DiplomaThesis $diplomathese
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(DiplomaThesis $diplomathese)
    {
        $students = Student::all();
        $teacher = Auth::user()->teacher;
        $topics = Topic::all();
        return view('dashboard.diplomaTheses.edit', compact('diplomathese', 'students', 'teacher', 'topics'));
    }

    /**
     * @param EditDiplomaThesisRequest $request
     * @param DiplomaThesis $diplomathese
     * @return \Illuminate\Http\RedirectResponse
     * @throws FileIsTooBig
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'topic_id' => 'required|array',
            'topic_id.*' => 'exists:topics,id',
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'exists:teachers,id',
        ]);

        $diplomathesis = Diplomathesis::findOrFail($id);

        $diplomathesis->title = $validatedData['title'];
        $diplomathesis->abstract = $validatedData['abstract'];
        $diplomathesis->topics()->sync($validatedData['topic_id']);
        $diplomathesis->teacher()->sync($validatedData['teacher_id']);
        $diplomathesis->save();

        return redirect()->route('dashboard.diplomatheses.index')->with('success', 'Diplomadolgozat sikeresen módosítva!');
    }

    public function editAcceptedThesis(DiplomaThesis $diplomathese)
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $topics = Topic::all();
        return view('dashboard.diplomaTheses.editAccepted', compact('diplomathese', 'students', 'teachers', 'topics'));
    }

    public function publish(EditDiplomaThesisRequest $request, DiplomaThesis $diplomathese)
    {
        DB::beginTransaction();
        try {
            $diplomathese->teacher()->detach();
            $diplomathese->topics()->detach();
            $teacher_user_id = $request->input('teacher_id');
            $topic_id = $request->input('topic_id');
            $diplomathese->update($request->validated());
            $diplomathese->teacher()->attach($teacher_user_id);
            $diplomathese->topics()->attach($topic_id);
            if($request->file('availability') != null){
                File::deleteDirectory(storage_path('app/public/diplomatheses/diplomathese_' . $diplomathese->id));
                $diplomathese->clearMediaCollection('dipl_availability');
                $file = $request->file('availability');
                $diplomathese->addMedia($file)->toMediaCollection('dipl_availability', 'diplomatheses');
            }else if($request->has('image_cb')){
                $diplomathese->clearMediaCollection('dipl_availability');
            }
        } catch (FileDoesNotExist $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az diplomadolgozat közzé tétele sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.diplomatheses.index');
    }

    /**
     * @param DiplomaThesis $diplomathese
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(DiplomaThesis $diplomathese)
    {
        $diplomathese->clearMediaCollection('dipl_availability');
        File::deleteDirectory(storage_path('app/public/diplomatheses/diplomathese_' . $diplomathese->id/*.'_'.$diplomathese->title*/));
        $diplomathese->delete();
        return redirect()->route('dashboard.diplomatheses.index');
    }
}
