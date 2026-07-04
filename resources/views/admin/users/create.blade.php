<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New User') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 font-medium transition">
                <i class="fas fa-arrow-left mr-1"></i> Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ role: '{{ old('role', 'faculty') }}' }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-8">
                
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Role Selection -->
                        <div class="md:col-span-2 mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">User Role</label>
                            <div class="flex space-x-6">
                                <label class="flex items-center">
                                    <input type="radio" name="role" value="faculty" x-model="role" class="text-fcrit-600 focus:ring-fcrit-500 border-gray-300">
                                    <span class="ml-2 text-gray-700">Faculty</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="role" value="student" x-model="role" class="text-fcrit-600 focus:ring-fcrit-500 border-gray-300">
                                    <span class="ml-2 text-gray-700">Student</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Department (Visible for all except admin maybe, but keep for all) -->
                        <div class="md:col-span-2" x-show="role !== 'admin'">
                            <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="department" name="department" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                                <option value="">Select Department</option>
                                <option value="CE" {{ old('department') == 'CE' ? 'selected' : '' }}>Computer Engineering (CE)</option>
                                <option value="ME" {{ old('department') == 'ME' ? 'selected' : '' }}>Mechanical Engineering (ME)</option>
                                <option value="EXTC" {{ old('department') == 'EXTC' ? 'selected' : '' }}>Electronics & Telecommunication (EXTC)</option>
                                <option value="EE" {{ old('department') == 'EE' ? 'selected' : '' }}>Electrical Engineering (EE)</option>
                                <option value="CSE" {{ old('department') == 'CSE' ? 'selected' : '' }}>Computer Science & Engineering (CSE)</option>
                                <option value="BSH" {{ old('department') == 'BSH' ? 'selected' : '' }}>Basic Sciences & Humanities (BSH)</option>
                            </select>
                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                        </div>

                        <!-- Student specific fields -->
                        <div x-show="role === 'student'" class="contents">
                            <div>
                                <label for="roll_number" class="block text-sm font-medium text-gray-700 mb-1">Roll Number *</label>
                                <input id="roll_number" type="text" name="roll_number" value="{{ old('roll_number') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                                <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
                            </div>

                            <div>
                                <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Semester *</label>
                                <select id="semester" name="semester" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                                    <option value="">Select Semester</option>
                                    @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>
                        </div>

                        <div class="md:col-span-2 border-t border-gray-200 mt-4 pt-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wider">Account Security</h3>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password *</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-fcrit-500 focus:border-fcrit-500">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.users.index') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-50 transition shadow-sm">
                            Cancel
                        </a>
                        <button type="submit" class="bg-fcrit-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-fcrit-700 transition shadow-sm">
                            Create User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
