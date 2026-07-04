<x-guest-layout>
    @php
        $role = request('role', 'student');
        $roleLabels = ['student' => 'Student', 'faculty' => 'Faculty', 'admin' => 'Admin'];
        $roleLabel = $roleLabels[$role] ?? 'Student';
    @endphp

    <!-- Title -->
    <div class="mb-6 text-center">
        <h2 id="login-title" class="text-2xl font-bold text-gray-800">{{ $roleLabel }} Login</h2>
        <p class="text-sm text-gray-500 mt-1">Sign in to your {{ strtolower($roleLabel) }} account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="login-form">
        @csrf

        <!-- Pass role as hidden field -->
        <input type="hidden" name="role" value="{{ $role }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="login-email" :value="__('Email Address')" />
            <x-text-input id="login-email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="login-password" :value="__('Password')" />
            <x-text-input id="login-password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="login-remember" class="inline-flex items-center">
                <input id="login-remember" type="checkbox" class="rounded border-gray-300 text-fcrit-600 shadow-sm focus:ring-fcrit-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a id="login-forgot-link" class="text-sm text-fcrit-600 hover:text-fcrit-700 font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3" id="login-submit-btn">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white text-gray-400">or continue with</span>
        </div>
    </div>

    <!-- Google Sign In -->
    <a href="{{ route('auth.google') }}" id="login-google-btn"
       class="w-full inline-flex items-center justify-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition-all duration-200">
        <!-- Google SVG -->
        <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
        </svg>
        Sign in with Google
    </a>

    <!-- Footer Links -->
    <div class="mt-6 text-center space-y-2">
        @if($role === 'student')
            <p class="text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}?role=student" id="login-register-link" class="text-fcrit-600 hover:text-fcrit-700 font-semibold transition-colors duration-200">
                    Register here
                </a>
            </p>
        @endif
    </div>
</x-guest-layout>
