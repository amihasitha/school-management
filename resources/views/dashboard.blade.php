<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        @if (auth()->user()->user_type === 'super_admin')
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-l">
                <a href="{{ route('teachers.index') }}"
                class="inline-flex items-center px-4 py-2
                        bg-[#0F5C33] border border-transparent
                        rounded-md font-semibold text-xs text-white
                        uppercase tracking-widest
                        hover:bg-green-800 focus:outline-none
                        focus:ring-2 focus:ring-green-500
                        focus:ring-offset-2 transition">
                        {{ __('View All Teachers') }}                        
                </a>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-l">
                <a href="{{ route('students.index') }}"
                class="inline-flex items-center px-4 py-2
                        bg-[#0F5C33] border border-transparent
                        rounded-md font-semibold text-xs text-white
                        uppercase tracking-widest
                        hover:bg-green-800 focus:outline-none
                        focus:ring-2 focus:ring-green-500
                        focus:ring-offset-2 transition">
                        {{ __('View All Students') }}                        
                </a>
            </div>
        @endif
        </div>
    </div>

</x-app-layout>
