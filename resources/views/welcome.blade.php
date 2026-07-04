<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FCRIT IMS — Information Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FDFFF7] text-gray-800">

    <!-- Header -->
    <header class="w-full py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto text-center">
            <div class="flex items-center justify-center gap-3 mb-2">
                <!-- FCRIT Emblem SVG -->
                <svg id="welcome-fcrit-logo" class="w-12 h-12 text-fcrit-600" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="4" y="4" width="56" height="56" rx="12" stroke="currentColor" stroke-width="3" fill="none"/>
                    <path d="M20 18h24v4H24v6h16v4H24v10h-4V18z" fill="currentColor"/>
                </svg>
                <div>
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-fcrit-600 leading-tight">
                        Fr. Conceicao Rodrigues Institute of Technology
                    </h1>
                </div>
            </div>
            <p class="text-sm sm:text-base text-gray-500 font-medium tracking-wide uppercase mt-1">
                Information Management System
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16">
        <div class="max-w-5xl mx-auto w-full">

            <!-- Subtitle -->
            <div class="text-center mb-10 sm:mb-14">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">Welcome to the FCRIT IMS Portal</h2>
                <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto">
                    Track academic achievements, manage student records, and streamline institutional processes. Select your role to continue.
                </p>
            </div>

            <!-- Role Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

                <!-- Student Card -->
                <div id="card-student" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out">
                    <div class="w-16 h-16 mx-auto mb-5 bg-fcrit-50 rounded-xl flex items-center justify-center group-hover:bg-fcrit-100 transition-colors duration-300">
                        <!-- Graduation Cap SVG -->
                        <svg class="w-8 h-8 text-fcrit-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15v-3.75m0 0h10.5"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Student Portal</h3>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                        Register or login to submit and track your academic achievements and certifications.
                    </p>
                    <a id="btn-student-register" href="/register?role=student"
                       class="inline-block w-full px-6 py-3 bg-fcrit-600 text-white font-semibold rounded-lg hover:bg-fcrit-700 focus:outline-none focus:ring-2 focus:ring-fcrit-500 focus:ring-offset-2 transition-all duration-200">
                        Continue as Student
                    </a>
                    <a id="link-student-login" href="/login?role=student" class="inline-block mt-3 text-sm text-fcrit-600 hover:text-fcrit-700 font-medium transition-colors duration-200">
                        Already have an account? Login →
                    </a>
                </div>

                <!-- Faculty Card -->
                <div id="card-faculty" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out">
                    <div class="w-16 h-16 mx-auto mb-5 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300">
                        <!-- Clipboard SVG -->
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Faculty Portal</h3>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                        Review and manage student achievement submissions for your department.
                    </p>
                    <a id="btn-faculty-login" href="/login?role=faculty"
                       class="inline-block w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                        Continue as Faculty
                    </a>
                </div>

                <!-- Admin Card -->
                <div id="card-admin" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out">
                    <div class="w-16 h-16 mx-auto mb-5 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-gray-200 transition-colors duration-300">
                        <!-- Shield/Settings SVG -->
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Admin Panel</h3>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                        Manage student and faculty accounts, oversee system operations and reports.
                    </p>
                    <a id="btn-admin-login" href="/login?role=admin"
                       class="inline-block w-full px-6 py-3 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        Continue as Admin
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-8 px-4 border-t border-gray-200 mt-8">
        <div class="max-w-5xl mx-auto text-center">
            <p class="text-sm text-gray-400 leading-relaxed">
                Agnel Technical Education Complex, Sector 9-A, Vashi, Navi Mumbai – 400703
            </p>
            <p class="text-xs text-gray-300 mt-2">
                &copy; {{ date('Y') }} Fr. Conceicao Rodrigues Institute of Technology. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>