<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ExcelUserCreateRequest;
use App\Imports\UsersImport;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::all();
        $usersallrole = User::with('roles')->get();
        $users = $usersallrole->reject(function ($user, $key) {
            return $user->hasRole('SzuperAdminisztrátor');
        });
        return view('dashboard.users.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::get()->where('name', '<>', 'SzuperAdminisztrátor')->pluck('name', 'name');
        $classes = Classes::all();
        return view('dashboard.users.users.create', compact('roles', 'classes'));
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->validated());
            if($request->file('image') != null){
                $file = $request->file('image');
                $user->addMedia($file)->toMediaCollection('images', 'users');
            }
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);
            if ($user->hasRole('Hallgató')) {
                $datas = ["user_id" => $user->id, "classes_id" => $request->input('classes_id'), "workplace" => $request->input('workplace'), "year_of_finish" => $request->input('year_of_finish'), "status" => $request->input('status')];
                Student::create($datas);
            } else if ($user->hasRole('Tanár')) {
                $datas = ["user_id" => $user->id, "degree" => $request->input('degree'), "post" => $request->input('post')];
                Teacher::create($datas);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az felhasználó létrehozása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.users.index');
    }


    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        if ($user->id !== 1) {
            if ($user->hasRole('Hallgató')) {
                $roles = Role::where([['name', '<>', 'Tanár'], ['name', '<>', 'SzuperAdminisztrátor']])->get()->pluck('name', 'name');
            } else if ($user->hasRole('Tanár')) {
                $roles = Role::where([['name', '<>', 'Hallgató'], ['name', '<>', 'SzuperAdminisztrátor']])->get()->pluck('name', 'name');
            } else {
                $roles = Role::get()->where('name', '<>', 'SzuperAdminisztrátor')->pluck('name', 'name');
            }
            $classes = Classes::all();
            return view('dashboard.users.users.edit', compact('user', 'roles', 'classes'));
        } else {
            return redirect()->route('admin');
        }
    }

    /**
     * @param EditUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update($request->validated());
            if($request->file('image') != null){
                $user->clearMediaCollection('images');
                $file = $request->file('image');
                $user->addMedia($file)->toMediaCollection('images', 'users');
            }else if($request->has('image_cb')){
                $user->clearMediaCollection('images');
            }
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->syncRoles($roles);
            if ($user->hasRole('Hallgató')) {
                $existingStudent = Student::where('user_id', $user->id)->first();
                if ($existingStudent) {
                    $data = ["classes_id" => $request->input('classes_id'), "workplace" => $request->input('workplace'), "year_of_finish" => $request->input('year_of_finish'),  "status" => $request->input('status')];
                    $user->student->update($data);
                } else {
                    $data = ["user_id" => $user->id, "classes_id" => $request->input('classes_id'), "workplace" => $request->input('workplace'), "year_of_finish" => $request->input('year_of_finish'), "status" => $request->input('status')];
                    Student::create($data);
                }
            } else if ($user->hasRole('Tanár')) {
                $existingTeacher = Teacher::where('user_id', $user->id)->first();
                if ($existingTeacher) {
                    $data = ["degree" => $request->input('degree'), "post" => $request->input('post')];
                    $user->teacher->update($data);
                } else {
                    $data = ["user_id" => $user->id, "degree" => $request->input('degree'), "post" => $request->input('post')];
                    Teacher::create($data);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Az felhasználó módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('dashboard.users.index');
    }


    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user)
    {
        if ($user->id !== 1) {
            $user->clearMediaCollection('images');

            $user->delete();
            return redirect()->route('dashboard.users.index');
        } else {
            return redirect()->route('admin');
        }
    }

    /**
     * @param ExcelUserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ExcelUserCreateRequest $request)
    {
        Excel::import(new UsersImport, $request->file('file'));
        return back();
    }
}
