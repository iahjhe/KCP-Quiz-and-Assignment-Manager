<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

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

        // Redirect based on the user's role
        $role = Auth::user()->role;

        if ($role === 'student') {
            return redirect()->route('student.portal'); // Redirect to student portal
        } elseif ($role === 'teacher') {
            return redirect()->route('teacher.dashboard'); // Redirect to teacher dashboard
        } elseif ($role === 'admin') {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        }

        // Default fallback redirect if no role is matched
        return redirect()->route('dashboard');
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
