<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('pages.backend.profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $user->update([
            'name' => $request->name
        ]);

        return redirect()->route('dashboard.index')->withToastSuccess('Profile has been updated');
    }

    public function passwordEdit()
    {
        return view('auth.change');
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::findOrFail($id);

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            
            return redirect()->route('dashboard.index')->withToastSuccess('Your password has been updated');
        }

        return redirect()->back()->withErrors('Wrong password.');
    }
}
