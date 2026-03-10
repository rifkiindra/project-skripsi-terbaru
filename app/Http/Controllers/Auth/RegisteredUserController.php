<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // Validasi
    $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    'telepon' => ['nullable', 'string', 'max:20'],
    'alamat' => ['nullable', 'string', 'max:255'],
]);


    // Membuat user baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'member',
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
    ]);

    // Membuat record member terkait
    Member::create([
        'user_id' => $user->id,
        'nama' => $request->name,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'status' => 'active',
    ]);

    event(new Registered($user));
    //Auth::login($user);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
}

}
