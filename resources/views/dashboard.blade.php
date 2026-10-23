
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        {{-- Left Navigation Panel --}}
        @include('profile.partials.sidebar-navigation')

        {{-- Dashboard Content --}}
        <main class="min-w-0 flex-1 p-6 sm:p-8">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ __('Welcome, ') }}{{ auth()->user()->name }}!
                </h1>
                <p class="mt-1 text-gray-600">
                    {{ __('Welcome to the St. John\'s College Data Management System.') }}
                </p>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <p class="text-gray-900">
                    {{ __("You're logged in!") }}
                </p>
                <p class="mt-2 text-gray-900">
                    {{ __('Name : ') }}{{ auth()->user()->name }}
                </p>
                <p class="mt-2 text-gray-900">
                    {{ __('Email : ') }}{{ auth()->user()->email ?? 'N/A' }}
                </p>    
            </div>

        </main>
    </div>
</x-app-layout>
