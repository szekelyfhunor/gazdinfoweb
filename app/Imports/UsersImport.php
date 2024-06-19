<?php

namespace App\Imports;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
     * @param Collection $collection
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function collection(Collection $collection)
    {
        Validator::make($collection->toArray(),
            [
            '*.0' => 'required',
            '*.1' => 'nullable|email|unique:users,email',
            '*.2' => 'required',
            '*.3' => 'required_if:*.2,==,Hallgató',
            '*.4' => 'required_if:*.2,==,Hallgató',
            ],
            [
                '*.0.required' => 'Az első oszlop (név) megadása kötelező!',
                '*.1.email' => 'A második oszlop (email) egy valós email címe kell legyen!',
                '*.1.unique' => 'A második oszlopban (email) megadoot emailcím már használatban van!',
                '*.2.required' => 'A harmadik oszlop (rang) megadása kötelező!',
                '*.3.required_if' => 'A negyedik oszlop (évfolyam) megadása kötelező,
                                        ha a harmadik oszlop (rang) értéke hallgató!',
                '*.4.required_if' => 'Az ötödik oszlop (statusz) megadása kötelező,
                                        ha a harmadik oszlop (rang) értéke hallgató! (1, ha aktív, 0 ha inaktív.) '
            ]
        )->validate();
        DB::beginTransaction();
        foreach ($collection as $row)
        {
            $user = User::create([
                'name' => $row[0],
                'email' => $row[1],
            ]);
            if($row[2] == "Tanár"){
                Teacher::create([
                    'user_id' => $user->id,
                ]);
                $roleid = DB::table('roles')->where('name', $row[2])->first()->id;
                DB::table('model_has_roles')->insert([
                    'role_id' => $roleid,
                    'model_type' => User::class,
                    'model_id' => $user->id
                ]);
            }else if($row[2] == "Hallgató"){
                $classid = Classes::where('year', $row[3])->first()->id;
                Student::create([
                    'user_id' => $user->id,
                    'classes_id' => $classid,
                    'status' => $row[4]
                ]);
                $roleid = DB::table('roles')->where('name', $row[2])->first()->id;
                DB::table('model_has_roles')->insert([
                    'role_id' => $roleid,
                    'model_type' => User::class,
                    'model_id' => $user->id
                ]);
            }else if($row[2] == "Adminisztrátor"){
                $roleid = DB::table('roles')->where('name', $row[2])->first()->id;
                DB::table('model_has_roles')->insert([
                    'role_id' => $roleid,
                    'model_type' => User::class,
                    'model_id' => $user->id
                ]);
            }else{
                DB::rollBack();
                return redirect()->back()->withErrors('A felhasználó létrehozása sikertelen volt, a harmadik oszlopban adja meg a rangot (Hallgató/Tanár/Adminisztrátor) ');
            }
        }
        DB::commit();
    }
}
