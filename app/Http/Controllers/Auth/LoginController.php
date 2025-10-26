<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show login form for customers
     */
    public function show()
    {
        return view('auth.customer-login');
    }

    /**
     * Handle customer login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $user = auth()->user();
            $request->session()->regenerate();

            // Redirect based on user roles
            if ($user->hasAnyRole(['admin', 'nailist'])) {
                // If has admin/nailist role, go to role selection or direct dashboard
                if (count($user->roles) > 1) {
                    return redirect()->route('role.selection');
                }
                session(['active_role' => $user->roles[0]]);
                return redirect()->route($user->roles[0] . '.dashboard');
            }

            // Regular user - redirect to home
            return redirect()->intended(route('home'))->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
