<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleSelectionController extends Controller
{
    /**
     * Show role selection page
     */
    public function show()
    {
        $user = auth()->user();

        // If user only has one role, redirect directly
        if (count($user->roles) === 1) {
            return $this->redirectToRole($user->roles[0]);
        }

        return view('auth.role-selection', compact('user'));
    }

    /**
     * Set active role and redirect
     */
    public function select(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,nailist',
        ]);

        $user = auth()->user();
        $role = $request->role;

        // Check if user has this role
        if (!$user->hasRole($role)) {
            return back()->with('error', 'You do not have access to this role.');
        }

        // Store active role in session
        session(['active_role' => $role]);

        return $this->redirectToRole($role);
    }

    /**
     * Redirect to appropriate dashboard based on role
     */
    private function redirectToRole($role)
    {
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'nailist' => redirect()->route('nailist.dashboard'),
            default => redirect()->route('home'),
        };
    }
}
