<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        $request->authenticate();
        $request->session()->regenerate();
    
        $user = Auth::user();
    
        if (! $user->actif) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Ce compte a été désactivé.']);
        }
    
        if ($user->role === 'medecin' && ! $user->medecin) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Ce compte médecin a été désactivé.']);
        }
    
        return match ($user->role) {
            'patient' => redirect()->intended(route('patient.dashboard')),
            'medecin' => redirect()->intended(route('medecin.dashboard')),
            'admin' => redirect()->intended(route('admin.dashboard')),
            'superadmin' => redirect()->intended(route('superadmin.dashboard')),
        };
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
