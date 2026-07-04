<nav x-data="{ open: false }" class="bg-fcrit-600 border-b border-fcrit-700" id="main-navigation">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Branding -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" id="nav-brand-link" class="flex items-center gap-2">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="4" width="56" height="56" rx="12" stroke="currentColor" stroke-width="3" fill="none"/>
                            <path d="M20 18h24v4H24v6h16v4H24v10h-4V18z" fill="currentColor"/>
                        </svg>
                        <span class="text-white font-bold text-lg tracking-wide">FCRIT IMS</span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:ml-8 space-x-1">
                    {{-- Student Links --}}
                    @if(auth()->user()->role === 'student')
                        <a href="{{ route('dashboard') }}" id="nav-student-dashboard"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('student.achievements.index') }}" id="nav-student-achievements"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('student.achievements.*') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            My Achievements
                        </a>
                        <a href="{{ route('student.profile.edit') }}" id="nav-student-profile"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('student.profile.edit') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            Profile
                        </a>
                    @endif

                    {{-- Faculty Links --}}
                    @if(auth()->user()->role === 'faculty')
                        <a href="{{ route('dashboard') }}" id="nav-faculty-dashboard"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('faculty.submissions.index') }}" id="nav-faculty-submissions"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('faculty.submissions.*') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            Submissions
                        </a>
                    @endif

                    {{-- Admin Links --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" id="nav-admin-dashboard"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}" id="nav-admin-users"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-fcrit-700 text-white' : 'text-fcrit-100 hover:bg-fcrit-700 hover:text-white' }}">
                            Manage Users
                        </a>
                    @endif
                </div>
            </div>

            <!-- Desktop User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button id="nav-user-dropdown-trigger" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-fcrit-100 hover:text-white hover:bg-fcrit-700 focus:outline-none transition-colors duration-200">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-fcrit-700 flex items-center justify-center text-white font-semibold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs text-gray-400 uppercase font-semibold">{{ Auth::user()->role }}</p>
                            <p class="text-sm text-gray-700 font-medium truncate">{{ Auth::user()->email }}</p>
                        </div>

                        @if(auth()->user()->role === 'student')
                            <x-dropdown-link :href="route('student.profile.edit')" id="nav-dropdown-profile">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" id="nav-logout-form">
                            @csrf
                            <x-dropdown-link :href="route('logout')" id="nav-dropdown-logout"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" id="nav-mobile-toggle"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-fcrit-200 hover:text-white hover:bg-fcrit-700 focus:outline-none focus:bg-fcrit-700 transition-colors duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-fcrit-700">
        <div class="pt-2 pb-3 space-y-1 px-3">
            @if(auth()->user()->role === 'student')
                <a href="{{ route('dashboard') }}" id="nav-mobile-student-dashboard"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('student.achievements.index') }}" id="nav-mobile-student-achievements"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.achievements.*') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    My Achievements
                </a>
                <a href="{{ route('student.profile.edit') }}" id="nav-mobile-student-profile"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('student.profile.edit') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    Profile
                </a>
            @endif

            @if(auth()->user()->role === 'faculty')
                <a href="{{ route('dashboard') }}" id="nav-mobile-faculty-dashboard"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('faculty.submissions.index') }}" id="nav-mobile-faculty-submissions"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('faculty.submissions.*') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    Submissions
                </a>
            @endif

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" id="nav-mobile-admin-dashboard"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" id="nav-mobile-admin-users"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-fcrit-800 text-white' : 'text-fcrit-100 hover:bg-fcrit-800 hover:text-white' }}">
                    Manage Users
                </a>
            @endif
        </div>

        <!-- Mobile User Info -->
        <div class="pt-4 pb-3 border-t border-fcrit-800 px-3">
            <div class="flex items-center px-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-fcrit-800 flex items-center justify-center text-white font-semibold text-sm mr-3">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-fcrit-200">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                @if(auth()->user()->role === 'student')
                    <a href="{{ route('student.profile.edit') }}" id="nav-mobile-profile"
                       class="block px-3 py-2 rounded-lg text-sm font-medium text-fcrit-100 hover:bg-fcrit-800 hover:text-white">
                        Profile
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" id="nav-mobile-logout-form">
                    @csrf
                    <button type="submit" id="nav-mobile-logout-btn"
                            class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-fcrit-100 hover:bg-fcrit-800 hover:text-white">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
