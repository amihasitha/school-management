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
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Your Name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email (Super Admin only) -->
                <template x-if="type === 'super_admin'">
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Your Email"/>
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
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Your Password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Your Password"/>
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