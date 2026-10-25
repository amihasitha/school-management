
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add New Teacher') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar --}}
        @include('profile.partials.sidebar-navigation')

        <main class="min-w-0 flex-1 p-6 sm:p-8">
            <div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Teacher Information') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('Enter the details to create a teacher account.') }}
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <p class="font-semibold">{{ __('Please correct the following errors:') }}</p>
                        <ul class="mt-2 list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('teachers.store') }}">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" />

                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('name')"
                            placeholder="Enter teacher's full name"
                            required
                            autofocus
                        />
                    </div>

                    {{-- NIC --}}
                    <div class="mt-4">
                        <x-input-label for="nic" :value="__('NIC Number')" />

                        <x-text-input
                            id="nic"
                            name="nic"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('nic')"
                            placeholder="Enter NIC number"
                            required
                        />
                    </div>

                    {{-- Email --}}
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email Address (Optional)')" />

                        <x-text-input
                            id="email"
                            name="email"
                            type="email"
                            class="mt-1 block w-full"
                            :value="old('email')"
                            placeholder="Enter email address (optional)"
                            autocomplete="email"
                        />
                    </div>

                    {{-- Password --}}
                    <div class="mt-4" x-data="{ showPassword: false }">
                        <x-input-label for="password" :value="__('Password')" />

                        <div class="relative mt-1">
                            <x-text-input
                                id="password"
                                name="password"
                                x-bind:type="showPassword ? 'text' : 'password'"
                                class="block w-full pe-10"
                                placeholder="Create a password"
                                required
                                autocomplete="new-password"
                            />

                            <button
                                type="button"
                                x-on:click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-[#0F5C33]"
                                style="right:0px; top: 10px;"
                                x-bind:aria-label="showPassword ? 'Hide password' : 'Show password'"
                            >
                                <svg x-show="!showPassword"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.7" stroke="currentColor"
                                     class="h-5 w-5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                                <svg x-cloak x-show="showPassword"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.7" stroke="currentColor"
                                     class="h-5 w-5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10.7 10.7 0 0 1 12 5c6.25 0 9.75 7 9.75 7a15.6 15.6 0 0 1-3.1 3.9M6.2 6.2C3.6 8 2.25 12 2.25 12s3.5 7 9.75 7c1.3 0 2.5-.3 3.6-.8" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mt-4" x-data="{ showConfirmPassword: false }">
                        <x-input-label for="password_confirmation"
                                       :value="__('Confirm Password')" />

                        <div class="relative mt-1">
                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                x-bind:type="showConfirmPassword ? 'text' : 'password'"
                                class="block w-full pe-10"
                                placeholder="Confirm password"
                                required
                                autocomplete="new-password"
                            />

                            <button
                                type="button"
                                x-on:click="showConfirmPassword = !showConfirmPassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-[#0F5C33]"
                                style="right:0px; top: 10px;"
                                x-bind:aria-label="showConfirmPassword ? 'Hide password' : 'Show password'"
                            >
                                <svg x-show="!showConfirmPassword"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.7" stroke="currentColor"
                                     class="h-5 w-5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                                <svg x-cloak x-show="showConfirmPassword"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.7" stroke="currentColor"
                                     class="h-5 w-5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10.7 10.7 0 0 1 12 5c6.25 0 9.75 7 9.75 7a15.6 15.6 0 0 1-3.1 3.9M6.2 6.2C3.6 8 2.25 12 2.25 12s3.5 7 9.75 7c1.3 0 2.5-.3 3.6-.8" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="mt-8 flex flex-wrap items-center justify-end gap-3 border-t border-gray-200 pt-4">
                        <a href="{{ route('teachers.index') }}"
                           class="rounded-md bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300 p-2">
                            {{ __('Cancel') }}
                        </a>

                        <button type="submit"
                                class="rounded-md bg-[#0F5C33] px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-800 p-2">
                            {{ __('Create Teacher') }}
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>
