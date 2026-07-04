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
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * Accepts an optional ?role= query parameter to pre-select the role context.
     */
    public function create(Request $request): View
    {
        return view('auth.register', [
            'role' => $request->query('role', 'student'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'       => ['nullable', 'string', 'regex:/^[6-9]\d{9}$/'],
            'roll_number' => ['required_if:_role,student', 'nullable', 'string', 'regex:/^(10|20|30|40|50)\d{5}$/'],
            'department'  => ['required', 'string', 'in:CE,ME,EXTC,EE,CSE,BSH'],
            'semester'    => ['required_if:_role,student', 'nullable', 'string', 'in:1,2,3,4,5,6,7,8'],
        ]);

        // Role is always forced to 'student' — never trust user input for role
        $user = User::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'role'        => 'student',
            'phone'       => $validated['phone'] ?? null,
            'roll_number' => $validated['roll_number'] ?? null,
            'department'  => $validated['department'],
            'semester'    => $validated['semester'] ?? null,
            'is_active'   => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
