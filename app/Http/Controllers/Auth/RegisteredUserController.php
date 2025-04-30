<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'string', 'min:10', 'max:15'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'signature' => ['required']
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'no_hp' => $request->no_hp,
        //     'password' => Hash::make($request->password),
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'signature' => $request->signature,
            'is_active' => false
        ]);

        $user->assignRole('Petugas');

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect()->route('login')->with('success', 'Akun anda akan diaktifkan oleh Admin.');
    }
}
