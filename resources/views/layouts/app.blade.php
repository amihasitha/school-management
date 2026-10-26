<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', "St. John's College - Data Management System") }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow" style="background-color: rgb(243 244 246 / var(--tw-bg-opacity, 1));">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="height: 153px; text-align: center;">                        
                        <h3 class="text-lg font-bold" style="font-size: 30px;">{{ __('St. John\'s College, Nugegoda') }}</h3>
                        <p class="mt-1 text-sm text-green-100" style="font-size: 15px;">{{ __('Data Management System') }}</p>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
