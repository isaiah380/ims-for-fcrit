<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Redirect the authenticated user to their role-specific dashboard.
     */
    public function handle(Request $request): RedirectResponse
    {
        $user = $request->user();

        return match ($user->role) {
            'student' => redirect()->route('student.dashboard'),
            'faculty' => redirect()->route('faculty.dashboard'),
            'admin'   => redirect()->route('admin.dashboard'),
            default   => redirect('/'),
        };
    }
}
