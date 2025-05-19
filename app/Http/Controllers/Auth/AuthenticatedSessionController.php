<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User tidak terdaftar, mohon registrasi terlebih dahulu');
        }

        if ($user->is_active == 0) {
            return back()->with('inactive', 'Mohon hubungi admin terlebih dahulu untuk aktivasi akun');
        }

        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('PIC_Gudang')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboard');
        }

        auth()->user()->update([
            'last_active_at' => now()
        ]);

        return redirect()->intended('/');
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
