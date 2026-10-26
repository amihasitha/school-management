<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registered Teachers') }}
        </h2>
    </x-slot>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Left Navigation Panel --}}
        @include('profile.partials.sidebar-navigation')

        <main class="min-w-0 flex-1 p-6 sm:p-8">
            
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('All Teachers') }}
                    </h3>

                    <a href="{{ route('teachers.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-md
                            bg-[#0F5C33] px-5 py-2.5 text-sm font-semibold text-white
                            shadow-sm transition hover:bg-green-800
                            focus:outline-none focus:ring-2 focus:ring-[#0F5C33]
                            focus:ring-offset-2">
                        <span class="text-lg p-2">+</span>
                        {{ __('Add New Teacher') }}
                    </a>
                </div>

                <!-- Search & Filter Accordion -->
                <div x-data="{ open: {{ request()->hasAny(['search', 'email_status', 'date_from', 'date_to']) ? 'true' : 'false' }} }"
                    class="mb-6 overflow-hidden rounded-lg border border-gray-200">

                        <!-- Accordion Header -->
                        <button type="button"
                                @click="open = !open"
                                :aria-expanded="open.toString()"
                                aria-controls="teacher-filters"
                                class="flex w-full items-center justify-between bg-gray-50 px-5 py-4 text-left hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#0F5C33]">

                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-[#0F5C33]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-6 7v6l-4 2v-8L3 6V4z" />
                                </svg>

                                <span class="font-semibold text-gray-800">
                                    {{ __('Search & Filter Teachers') }}
                                </span>

                                @if (request()->hasAny(['search', 'email_status']))
                                    <span class="rounded-full bg-[#0F5C33] px-2 py-1 text-xs font-medium text-white">
                                        {{ __('Filters Applied') }}
                                    </span>
                                @endif
                            </span>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-500 transition-transform duration-200"
                                :class="{ 'rotate-180': open }"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                    <!-- Accordion Content -->
                    <div id="teacher-filters"
                        x-show="open"
                        x-transition
                        x-cloak
                        class="border-t border-gray-200 bg-white p-4">

                        <form method="GET"
                            action="{{ route('teachers.index') }}"
                            class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                            <!-- Search -->
                            <div>
                                <label for="search"
                                    class="block text-sm font-medium text-gray-700 pt-2">
                                    {{ __('Search') }}
                                </label>

                                <input id="search"
                                    name="search"
                                    type="text"
                                    value="{{ request('search') }}"
                                    placeholder="{{ __('Name, email, or NIC') }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-[#0F5C33] focus:ring-[#0F5C33]">
                            </div>

                            <!-- Email Status -->
                            <div>
                                <label for="email_status"
                                    class="block text-sm font-medium text-gray-700 pt-2">
                                    {{ __('Email Status') }}
                                </label>

                                <select id="email_status"
                                        name="email_status"
                                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-[#0F5C33] focus:ring-[#0F5C33]">
                                    <option value="">{{ __('All Teachers') }}</option>

                                    <option value="with_email"
                                        @selected(request('email_status') === 'with_email')>
                                        {{ __('With Email') }}
                                    </option>

                                    <option value="without_email"
                                        @selected(request('email_status') === 'without_email')>
                                        {{ __('Without Email') }}
                                    </option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-wrap gap-3 md:col-span-2 lg:col-span-4 pt-4">
                                <button type="submit"
                                        class="rounded-md bg-[#0F5C33] px-5 py-2 text-sm font-medium text-white hover:bg-green-800">
                                    {{ __('Search / Filter') }}
                                </button>

                                <a href="{{ route('teachers.index') }}"
                                class="rounded-md bg-gray-200 px-5 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">
                                    {{ __('Reset') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div role="status"
                        class="mb-4 rounded-md border border-green-200 bg-green-100 p-3 text-green-800 p-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#0F5C33] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('#') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Name') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Email') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('NIC Number') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Date Of Birth') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Address') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('First Appointment Date') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Current School Appointment Date') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Subject of Appointment') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Actions') }}</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-green-50' }} hover:bg-green-100 transition-colors duration-150">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->email ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->nic ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-M-d') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->address }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->first_appointment_date ? \Carbon\Carbon::parse($user->first_appointment_date)->format('Y-M-d') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->date_current_appointment_school ? \Carbon\Carbon::parse($user->date_current_appointment_school)->format('Y-M-d') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->appointment_subject }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <!-- Edit -->
                                        <a href="{{ route('teachers.edit', $user) }}"
                                        class="inline-block rounded-md bg-blue-600 px-3 py-2 text-black hover:bg-blue-700 font-semibold">
                                            {{ __('Edit') }}
                                        </a>
                                        <!-- End Edit -->

                                        <!-- Delete -->
                                        <form action="{{ route('teachers.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this teacher account? This action may be permanent.');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-block rounded-md bg-red-600 px-3 py-2 text-white hover:bg-red-700">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                        <!-- End Delete -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-4 py-6 text-center text-gray-500">
                                        {{ __('No Teachers found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>