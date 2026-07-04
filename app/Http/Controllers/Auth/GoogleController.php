<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google's OAuth consent screen.
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->stateless()
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    /**
     * Handle the callback from Google after authentication.
     *
     * Three scenarios:
     * 1. User exists (matched by google_id or email) → log in.
     * 2. Admin-created user (faculty) without google_id → link google_id and log in.
     * 3. Brand-new user → create as student and redirect to profile completion.
     */
    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Try to find existing user by google_id first, then by email
        $user = User::where('google_id', $googleUser->getId())->first()
            ?? User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // If user exists but doesn't have a google_id yet (e.g., admin-created faculty),
            // link their Google account
            if (! $user->google_id) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user, remember: true);

            return redirect()->route('dashboard');
        }

        // New user — create as student with basic info
        $user = User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar'    => $googleUser->getAvatar(),
            'role'      => 'student',
            'is_active' => true,
            'password'  => '',
        ]);

        Auth::login($user, remember: true);

        // Redirect new students to complete their profile (roll number, department, etc.)
        return redirect()->route('student.profile.edit')
            ->with('info', 'Please complete your profile to continue.');
    }
}
