<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if(session('success'))
            <div id="profile-success-msg" class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Profile Information</h3>
                <p class="text-sm text-gray-500 mt-1">Update your personal and academic details.</p>
            </div>

            <form method="POST" action="{{ route('student.profile.update') }}" id="profile-form" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <x-input-label for="profile-name" :value="__('Full Name')" />
                    <x-text-input id="profile-name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email (readonly) -->
                <div>
                    <x-input-label for="profile-email" :value="__('Email Address')" />
                    <x-text-input id="profile-email" class="block mt-1 w-full bg-gray-50 text-gray-500 cursor-not-allowed" type="email" name="email" :value="$user->email" disabled />
                    <p class="text-xs text-gray-400 mt-1">Email cannot be changed. Contact admin if needed.</p>
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="profile-phone" :value="__('Phone Number')" />
                    <x-text-input id="profile-phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone', $user->phone)" placeholder="Enter your phone number" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Roll Number -->
                <div>
                    <x-input-label for="profile-roll-number" :value="__('Roll Number')" />
                    <x-text-input id="profile-roll-number" class="block mt-1 w-full" type="text" name="roll_number" :value="old('roll_number', $user->roll_number)" required />
                    <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
                </div>

                <!-- Department & Semester Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="profile-department" :value="__('Department')" />
                        <select id="profile-department" name="department" required
                                class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                            <option value="">Select Department</option>
                            @foreach(['CE' => 'Computer Engineering', 'ME' => 'Mechanical Engineering', 'EXTC' => 'Electronics & Telecomm.', 'EE' => 'Electrical Engineering', 'CSE' => 'Computer Science & Engg.', 'BSH' => 'Basic Sciences & Humanities'] as $code => $name)
                                <option value="{{ $code }}" {{ old('department', $user->department) === $code ? 'selected' : '' }}>{{ $code }} — {{ $name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="profile-semester" :value="__('Semester')" />
                        <select id="profile-semester" name="semester" required
                                class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                            <option value="">Select Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester', $user->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex items-center justify-end pt-2">
                    <x-primary-button id="profile-save-btn">
                        {{ __('Save Changes') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
