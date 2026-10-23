<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registered Students') }}
        </h2>
    </x-slot>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Left Navigation Panel --}}
        @include('profile.partials.sidebar-navigation')

        <main class="min-w-0 flex-1 p-6 sm:p-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('All Students') }}
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#0F5C33] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('#') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Name') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Index Number') }}</th>
                                <th class="px-4 py-3 text-left text-sm p-2">{{ __('Registered Date') }}</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->index_number ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->created_at?->format('Y-M-d') ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-4 py-6 text-center text-gray-500">
                                        {{ __('No Students found.') }}
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