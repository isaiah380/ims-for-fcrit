<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FCRIT IMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#FDFFF7]">

            <!-- FCRIT Branding -->
            <div class="mb-6 text-center">
                <a href="/" id="guest-home-link" class="group inline-flex flex-col items-center gap-2 transition-opacity hover:opacity-80">
                    <svg class="w-12 h-12 text-fcrit-600" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="4" width="56" height="56" rx="12" stroke="currentColor" stroke-width="3" fill="none"/>
                        <path d="M20 18h24v4H24v6h16v4H24v10h-4V18z" fill="currentColor"/>
                    </svg>
                    <div>
                        <h1 class="text-lg font-bold text-fcrit-600 leading-tight">FCRIT</h1>
                        <p class="text-xs text-gray-400 font-medium tracking-wider uppercase">Information Management System</p>
                    </div>
                </a>
            </div>

            <!-- Form Card -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-sm border border-gray-100 overflow-hidden rounded-xl">
                {{ $slot }}
            </div>

            <!-- Back to Home -->
            <div class="mt-6">
                <a href="/" id="guest-back-link" class="text-sm text-gray-400 hover:text-fcrit-600 font-medium transition-colors duration-200">
                    ← Back to role selection
                </a>
            </div>
        </div>
    </body>
</html>
