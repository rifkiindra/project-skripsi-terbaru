<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile.
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update profile (nama, email, foto).
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        // UPDATE FOTO PROFIL (jika ada upload)
        if ($request->hasFile('profile_photo')) {

            $path = $request->file('profile_photo')->store('profile', 'public');

            // simpan di database
            $user->profile_photo_url = '/storage/' . $path;
        }

        // UPDATE NAMA & EMAIL
        $user->name  = $request->name;
        $user->email = $request->email;

        $user->save(); // <— INI SUDAH BETUL, TIDAK AKAN ADA MERAH

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // CEK PASSWORD LAMA
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        // UPDATE PASSWORD BARU
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
