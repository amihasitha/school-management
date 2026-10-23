<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex flex-col items-center justify-center text-center mb-6 p-10 pb-3 bg-[#0F5C33]">
        <a href="/" class="flex justify-center">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
        <div class="mt-4 w-full text-center">
            <span class="block text-center font-semibold text-white leading-tight">{{ __('St. John\'s College') }}</span>
            <span class="block text-center text-xs font-normal text-white">{{ __('Nugegoda') }}</span>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" x-data="{ type: @js(old('user_type', '')) }">
        @csrf

        <!-- User Type -->
        <div>
            <x-input-label for="user_type" :value="__('User Type')" />

            <select id="user_type" name="user_type" x-model="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                <option value="" disabled>{{ __('Select User Type') }}</option>
                <option value="super_admin">{{ __('Super Admin') }}</option>
                <option value="teacher">{{ __('Teacher') }}</option>
                <option value="student">{{ __('Student') }}</option>
            </select>

            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <template x-if="type === 'super_admin'">
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Your Email"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </template>

        <template x-if="type === 'teacher'">
            <div class="mt-4">
                <x-input-label for="nic" :value="__('NIC Number')" />
                <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required autocomplete="username" placeholder="Your NIC Number"/>
                <x-input-error :messages="$errors->get('nic')" class="mt-2" />
            </div>
        </template>

        <template x-if="type === 'student'">
            <div class="mt-4">
                <x-input-label for="index_number" :value="__('Index Number')" />
                <x-text-input id="index_number" class="block mt-1 w-full" type="text" name="index_number" :value="old('index_number')" required autocomplete="username" placeholder="Your Index Number"/>
                <x-input-error :messages="$errors->get('index_number')" class="mt-2" />
            </div>
        </template>

        <template x-if="type">
            <div>
                <!-- Password with Show/Hide Eye Icon -->
                <div class="mt-4" x-data="{ showPassword: false }">
                    <x-input-label for="password" :value="__('Password')" />

                    <div class="relative mt-1">
                        <input
                            id="password"
                            class="block w-full rounded-md border-gray-300 pe-10 shadow-sm
                                focus:border-[#0F5C33] focus:ring-[#0F5C33]
                                dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Your Password"
                        />

                        <button
                            type="button"
                            x-on:click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3
                                text-gray-500 hover:text-[#0F5C33]
                                focus:outline-none" style="right:0px; top: 10px;"
                            x-bind:aria-label="showPassword ? 'Hide password' : 'Show password'"
                            x-bind:title="showPassword ? 'Hide password' : 'Show password'"
                        >
                            <!-- Eye icon -->
                            <svg
                                x-show="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="h-5 w-5"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>

                            <!-- Eye-off icon -->
                            <svg
                                x-show="showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="h-5 w-5"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10.7 10.7 0 0 1 12 5c6.25 0 9.75 7 9.75 7a15.6 15.6 0 0 1-3.1 3.9M6.2 6.2C3.6 8 2.25 12 2.25 12s3.5 7 9.75 7c1.3 0 2.5-.3 3.6-.8" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
            </div>
        </template>

        <div class="flex items-center justify-end mt-4">
            {{-- Password reset by email only works for accounts that have an email (Super Admin). --}}
            <template x-if="type === 'super_admin'">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </template>
            <template x-if="type === 'teacher' || type === 'student'">
                <span class="text-sm text-gray-600">{{ __('Forgot your password? Ask your administrator.') }}</span>
            </template>

            <x-primary-button class="ms-3" x-bind:disabled="!type">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>