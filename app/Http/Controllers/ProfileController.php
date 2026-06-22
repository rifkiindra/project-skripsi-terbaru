<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display profile page.
     */
    public function edit()
    {
        return view('profile.edit');
    }


    /**
     * Update profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);


        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }


        if ($request->hasFile('profile_photo')) {

            $path = $request
                ->file('profile_photo')
                ->store('profile', 'public');

            $user->profile_photo_url =
                '/storage/' . $path;
        }


        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();


        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Profil berhasil diperbarui!'
            );
    }



    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                'min:8'
            ],
        ]);


        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }


        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {

            return back()->withErrors([
                'current_password'
                => 'Password lama tidak sesuai'
            ]);
        }


        $user->password =
            Hash::make($request->password);


        $user->save();


        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Password berhasil diperbarui!'
            );
    }




    /**
     * Delete account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);


        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }


        if (!Hash::check(
            $request->password,
            $user->password
        )) {

            return back()->withErrors([
                'password'
                => 'Password tidak sesuai'
            ]);
        }


        Auth::logout();


        $user->delete();


        $request->session()->invalidate();

        $request
            ->session()
            ->regenerateToken();


        return redirect('/');
    }
}