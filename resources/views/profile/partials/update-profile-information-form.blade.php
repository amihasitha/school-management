<section x-data="{ type: @js(old('user_type', $user->user_type)) }">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <template x-if="type === 'super_admin' || type === 'teacher'">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" x-bind:required="type === 'super_admin'" autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </template>
        <template x-if="type === 'teacher'">
            <div>
                <x-input-label for="nic" :value="__('NIC Number')" />

                <x-text-input 
                    id="nic" 
                    name="nic" 
                    type="text" 
                    class="mt-1 block w-full" 
                    :value="old('nic', $user->nic)" 
                    autocomplete="off"
                />

                <x-input-error 
                    class="mt-2"
                    :messages="$errors->get('nic')"
                />
            </div>
        </template>
        <template x-if="type === 'teacher' || type === 'student'">
            <div>
                <x-input-label for="dob" :value="__('Date of Birth')" />

                <x-text-input
                    id="dob"
                    name="dob"
                    type="date"
                    class="mt-1 block"
                    :value="old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '')"
                    autocomplete="off"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('dob')"
                />
            </div>
        </template>
        <template x-if="type === 'teacher' || type === 'student'">
            <div>
                <x-input-label for="address" :value="__('Address')" />

                <x-text-input
                    id="address"
                    name="address"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('address', $user->address)"
                    autocomplete="street-address"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('address')"
                />
            </div>
        </template>
        <template x-if="type === 'teacher'">
            <div>
                <x-input-label for="first_appointment_date" :value="__('1st Appointment Date')" />

                <x-text-input
                    id="first_appointment_date"
                    name="first_appointment_date"
                    type="date"
                    class="mt-1 block"
                    :value="old('first_appointment_date', $user->first_appointment_date ? \Carbon\Carbon::parse($user->first_appointment_date)->format('Y-m-d') : '')"
                    autocomplete="off"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('first_appointment_date')"
                />
            </div>
        </template>
        <template x-if="type === 'teacher'">
            <div>
                <x-input-label for="date_current_appointment_school" :value="__('Appointment Date of the Current School')" />

                <x-text-input
                    id="date_current_appointment_school"
                    name="date_current_appointment_school"
                    type="date"
                    class="mt-1 block"
                    :value="old('date_current_appointment_school', $user->date_current_appointment_school ? \Carbon\Carbon::parse($user->date_current_appointment_school)->format('Y-m-d') : '')"
                    autocomplete="off"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('date_current_appointment_school')"
                />
            </div>
        </template>
        <template x-if="type === 'teacher'">
            <div>
                <x-input-label
                    for="appointment_subject"
                    :value="__('Subject of Appointment')"
                />

                <x-text-input
                    id="appointment_subject"
                    name="appointment_subject"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('appointment_subject', $user->appointment_subject)"
                    autocomplete="off"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('appointment_subject')"
                />
            </div>
        </template>    

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
