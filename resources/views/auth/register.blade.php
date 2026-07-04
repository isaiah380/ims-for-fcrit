<x-guest-layout>
    <!-- Title -->
    <div class="mb-6 text-center">
        <h2 id="register-title" class="text-2xl font-bold text-gray-800">Student Registration</h2>
        <p class="text-sm text-gray-500 mt-1">Create your student account to get started</p>
    </div>

    <form method="POST" action="{{ route('register') }}" id="register-form">
        @csrf

        <!-- Hidden Role -->
        <input type="hidden" name="role" value="student">

        <!-- Name -->
        <div>
            <x-input-label for="register-name" :value="__('Full Name')" />
            <x-text-input id="register-name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="register-email" :value="__('Email Address')" />
            <x-text-input id="register-email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your.email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone (Optional) -->
        <div class="mt-4">
            <x-input-label for="register-phone" :value="__('Phone Number (Optional)')" />
            <x-text-input id="register-phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" autocomplete="tel" placeholder="Enter your phone number" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Roll Number -->
        <div class="mt-4">
            <x-input-label for="register-roll-number" :value="__('Roll Number')" />
            <x-text-input id="register-roll-number" class="block mt-1 w-full" type="text" name="roll_number" :value="old('roll_number')" required placeholder="e.g., 5024121" />
            <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
        </div>

        <!-- Department & Semester Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <!-- Department -->
            <div>
                <x-input-label for="register-department" :value="__('Department')" />
                <select id="register-department" name="department" required
                        class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                    <option value="">Select Department</option>
                    <option value="CE" {{ old('department') === 'CE' ? 'selected' : '' }}>CE — Computer Engineering</option>
                    <option value="ME" {{ old('department') === 'ME' ? 'selected' : '' }}>ME — Mechanical Engineering</option>
                    <option value="EXTC" {{ old('department') === 'EXTC' ? 'selected' : '' }}>EXTC — Electronics & Telecomm.</option>
                    <option value="EE" {{ old('department') === 'EE' ? 'selected' : '' }}>EE — Electrical Engineering</option>
                    <option value="CSE" {{ old('department') === 'CSE' ? 'selected' : '' }}>CSE — Computer Science & Engg.</option>
                    <option value="BSH" {{ old('department') === 'BSH' ? 'selected' : '' }}>BSH — Basic Sciences & Humanities</option>
                </select>
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>

            <!-- Semester -->
            <div>
                <x-input-label for="register-semester" :value="__('Semester')" />
                <select id="register-semester" name="semester" required
                        class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                    <option value="">Select Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="register-password" :value="__('Password')" />
            <x-text-input id="register-password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="register-password-confirm" :value="__('Confirm Password')" />
            <x-text-input id="register-password-confirm" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3" id="register-submit-btn">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white text-gray-400">or sign up with</span>
        </div>
    </div>

    <!-- Google Sign Up -->
    <a href="{{ route('auth.google') }}" id="register-google-btn"
       class="w-full inline-flex items-center justify-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition-all duration-200">
        <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
        </svg>
        Sign up with Google
    </a>

    <!-- Footer Link -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-500">
            Already registered?
            <a href="{{ route('login') }}?role=student" id="register-login-link" class="text-fcrit-600 hover:text-fcrit-700 font-semibold transition-colors duration-200">
                Login here
            </a>
        </p>
    </div>
</x-guest-layout>
