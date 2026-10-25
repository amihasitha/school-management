<x-guest-layout>
    <div class="flex flex-col items-center justify-center text-center mb-6 p-10 pb-3 bg-[#0F5C33]">
        <a href="/" class="flex justify-center">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
        <div class="mt-4 w-full text-center">
            <span class="block text-center font-semibold text-white leading-tight">{{ __('St. John\'s College') }}</span>
            <span class="block text-center text-xs font-normal text-white">{{ __('Nugegoda') }}</span>
        </div>
    </div>
    <form method="POST" action="{{ route('register') }}" x-data="{ type: @js(old('user_type', '')) }">
        @csrf

        <!-- User Type -->
        <div class="mt-4">
            <x-input-label for="user_type" :value="__('User Type')" />

            <select id="user_type" name="user_type" x-model="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                <option value="" disabled>{{ __('Select User Type') }}</option>
                @if ($canRegisterSuperAdmin)
                    <option value="super_admin">{{ __('Super Admin') }}</option>
                @endif
                <option value="teacher">{{ __('Teacher') }}</option>
                <option value="student">{{ __('Student') }}</option>
            </select>

            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <template x-if="type">
            <div>
                <!-- Name (all types) -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__(' Full Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Your Name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email (Super Admin required, Teacher optional) -->
                <template x-if="type === 'super_admin' || type === 'teacher'">
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input
                            id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            x-bind:required="type === 'super_admin'"
                            autocomplete="username"
                            placeholder="Your Email"
                        />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </template>

                <!-- NIC (Teacher only) -->
                <template x-if="type === 'teacher'">
                    <div class="mt-4">
                        <x-input-label for="nic" :value="__('NIC Number')" />
                        <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required autocomplete="off" placeholder="Your NIC Number"/>
                        <x-input-error :messages="$errors->get('nic')" class="mt-2" />
                    </div>
                </template>

                <!-- Index Number (Student only) -->
                <template x-if="type === 'student'">
                    <div class="mt-4">
                        <x-input-label for="index_number" :value="__('Index Number')" />
                        <x-text-input id="index_number" class="block mt-1 w-full" type="text" name="index_number" :value="old('index_number')" required autocomplete="off" placeholder="Your Index Number"/>
                        <x-input-error :messages="$errors->get('index_number')" class="mt-2" />
                    </div>
                </template>

                <!-- Password -->
                <div class="mt-4" x-data="{ showPassword: false }">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative mt-1">
                        <x-text-input
                            id="password"
                            class="block w-full pe-10"
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            autocomplete="new-password"
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
                            <!-- Eye icon: password hidden -->
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

                            <!-- Eye-off icon: password visible -->
                            <svg
                                x-cloak
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

                <!-- Confirm Password -->
                <div class="mt-4" x-data="{ showConfirmPassword: false }">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <div class="relative mt-1">
                        <x-text-input
                            id="password_confirmation"
                            class="block w-full pe-10"
                            x-bind:type="showConfirmPassword ? 'text' : 'password'"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm Your Password"
                        />

                        <button
                            type="button"
                            x-on:click="showConfirmPassword = !showConfirmPassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3
                                text-gray-500 hover:text-[#0F5C33]
                                focus:outline-none" style="right:0px; top: 10px;"
                            x-bind:aria-label="showConfirmPassword ? 'Hide password' : 'Show password'"
                            x-bind:title="showConfirmPassword ? 'Hide password' : 'Show password'"
                        >
                            <!-- Eye icon: password hidden -->
                            <svg
                                x-show="!showConfirmPassword"
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

                            <!-- Eye-off icon: password visible -->
                            <svg
                                x-cloak
                                x-show="showConfirmPassword"
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

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </template>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" x-bind:disabled="!type">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>