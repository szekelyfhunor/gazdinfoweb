<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Scalar\String_;

/**
 *
 */
class ChangePasswordController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('dashboard.changepwd.edit', compact('user'));
    }

    /**
     * @param ChangePasswordRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChangePasswordRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            if (!Hash::check($request->input('old_password'), $user->password)) {
                return redirect()->back()->withErrors('A régi jelszó nem megfelelő!');
            } elseif (!auth()->user()->hasRole('SzuperAdminisztrátor')) {
                return redirect()->back()->withErrors('A jelszavát nem modosíthatja!');
            } else {
                $user->update(['password' => Hash::make($request->input('new_password'))]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('A jelszó módosítása sikertelen volt!');
        }
        DB::commit();
        return redirect()->route('admin')->with('message', 'Jelszava sikeresen módosítva lett!');
    }
}
