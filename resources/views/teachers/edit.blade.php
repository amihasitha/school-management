<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Teacher') }}
        </h2>
    </x-slot>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Left Navigation Panel --}}
        @include('profile.partials.sidebar-navigation')

        <main class="min-w-0 flex-1 p-6 sm:p-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Edit Teacher Details') }}
                    </h3>
                </div>
                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-100 p-4 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('teachers.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('Name') }}
                        </label>
                        <input id="name" name="name" type="text"
                               value="{{ old('name', $user->name) }}"
                               required
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('Email Address (Optional)') }}
                        </label>
                        <input id="email" name="email" type="email"
                               value="{{ old('email', $user->email) }}"
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-6">
                        <label for="nic"
                               class="block text-sm font-medium text-gray-700">
                            {{ __('NIC Number') }}
                        </label>
                        <input id="nic" name="nic" type="text"
                               value="{{ old('nic', $user->nic) }}"
                               required
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('teachers.index') }}"
                           class="rounded-md bg-gray-200 px-4 py-2 hover:bg-gray-300">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit"
                                class="rounded-md bg-[#0F5C33] px-4 py-2 text-white hover:bg-green-800">
                            {{ __('Update Teacher') }}
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>