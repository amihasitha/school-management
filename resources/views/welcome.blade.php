<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', "St. John's College Data Management System") }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F5FAF6] dark:bg-[#0a0f0a] text-[#1b1b18] antialiased flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

        <header class="w-full lg:max-w-5xl max-w-[420px] text-sm mb-6">
            <nav class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/st-johns-logo.jpg') }}" alt="St. John's College Crest" class="h-10 w-auto">
                    <span class="font-semibold text-[#0F5C33] dark:text-[#4ADE80] leading-tight">
                        {{ __('St. John\'s College') }}<br class="hidden sm:block">
                        <span class="text-xs font-normal text-[#3f6650] dark:text-[#8fc9a3]">{{ __('Nugegoda') }}</span>
                    </span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-3">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-1.5 bg-[#0F5C33] hover:bg-[#0c4a29] text-white rounded-md text-sm leading-normal transition"
                            >
                                {{ __('Dashboard') }}
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="inline-block px-5 py-1.5 border border-[#0F5C33]/30 hover:border-[#0F5C33] text-[#0F5C33] dark:text-[#4ADE80] dark:border-[#4ADE80]/30 dark:hover:border-[#4ADE80] rounded-md text-sm leading-normal transition"
                            >
                                {{ __('Log in') }}
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-block px-5 py-1.5 bg-[#0F5C33] hover:bg-[#0c4a29] text-white rounded-md text-sm leading-normal transition"
                                >
                                    {{ __('Register') }}
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>

        <div class="flex items-center justify-center w-full lg:grow">
            <main class="flex max-w-[420px] w-full flex-col-reverse lg:max-w-5xl lg:flex-row rounded-xl overflow-hidden shadow-[0_1px_3px_rgba(0,0,0,0.08),0_8px_24px_rgba(0,0,0,0.06)]">

                <div class="flex-1 p-8 lg:p-14 bg-white dark:bg-[#101a12] dark:text-[#EDEDEC]">
                    <span class="inline-block text-xs font-semibold tracking-wider uppercase text-[#0F5C33] dark:text-[#4ADE80] mb-3">
                        {{ __('Data Management System') }}
                    </span>

                    <h1 class="text-2xl lg:text-3xl font-bold leading-tight mb-4 text-[#12331f] dark:text-white">
                        {{ __('St. John\'s College') }}<br>{{ __('Data Management System') }}
                    </h1>

                    <p class="text-[#4b5f52] dark:text-[#A1A09A] leading-relaxed mb-6">
                        {{ __('A centralized platform for managing student records, subject marks, class rankings,
                        and teacher profiles — built to support the academic administration of
                        St. John\'s College, Nugegoda.') }}
                    </p>

                    <ul class="flex flex-col gap-3 mb-8 text-sm text-[#33473a] dark:text-[#c7d9cd]">
                        <li class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0F5C33]/10 text-[#0F5C33] dark:bg-[#4ADE80]/15 dark:text-[#4ADE80] text-xs">&#10003;</span>
                            {{ __('Import subject marks in bulk via CSV') }}
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0F5C33]/10 text-[#0F5C33] dark:bg-[#4ADE80]/15 dark:text-[#4ADE80] text-xs">&#10003;</span>
                            {{ __('Automatic median calculation and class ranking') }}
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-[#0F5C33]/10 text-[#0F5C33] dark:bg-[#4ADE80]/15 dark:text-[#4ADE80] text-xs">&#10003;</span>
                            {{ __('Teacher and student profile management') }}
                        </li>
                    </ul>

                    <p class="text-xs text-[#6b7d70] dark:text-[#7a8f7f]">
                        v{{ app()->version() }} {{ __('· “Nil Desperandum“') }}
                    </p>
                </div>

                <div class="relative bg-[#0F5C33] dark:bg-[#0a2213] w-full lg:w-[380px] shrink-0 flex items-center justify-center p-10">
                    <img
                        src="{{ asset('images/st-johns-logo.jpg') }}"
                        alt="St. John's College Crest"
                        class="w-full max-w-[220px] h-auto drop-shadow-lg"
                    >
                </div>
            </main>
        </div>

        <footer class="mt-6 text-xs text-[#6b7d70] dark:text-[#7a8f7f]">
            &copy; {{ date('Y') }} {{ __('St. John\'s College, Nugegoda. All rights reserved.') }}
        </footer>
    </body>
</html>