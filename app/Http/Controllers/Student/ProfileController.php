<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the student profile edit form.
     */
    public function edit(Request $request): View
    {
        return view('student.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the student's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['nullable', 'string', 'regex:/^[6-9]\d{9}$/'],
            'roll_number' => ['nullable', 'string', 'regex:/^(10|20|30|40|50)\d{5}$/'],
            'department'  => ['nullable', 'string', 'max:50'],
            'semester'    => ['nullable', 'string', 'max:10'],
        ]);

        $request->user()->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}
