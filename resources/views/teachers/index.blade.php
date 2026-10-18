
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registered Teachers') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-[#0F5C33]">
                        {{ __('All Teachers') }}
                    </h3>

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 bg-gray-200 rounded-md
                              text-sm hover:bg-gray-300">
                        {{ __('Back to Profile') }}
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#0F5C33] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm">{{ __('#') }}</th>
                                <th class="px-4 py-3 text-left text-sm">{{ __('User') }} Type</th>
                                <th class="px-4 py-3 text-left text-sm">{{ __('Name') }}</th>
                                <th class="px-4 py-3 text-left text-sm">{{ __('Email') }}</th>
                                <th class="px-4 py-3 text-left text-sm">{{ __('NIC Number') }}</th>
                                <th class="px-4 py-3 text-left text-sm">{{ __('Index Number') }}</th>
                                <th class="px-4 py-3 text-left text-sm">{{ __('Registered Date') }}</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ ucfirst(str_replace('_', ' ', $user->user_type)) }}
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
                                        {{ $user->index_number ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->created_at?->format('Y-m-d') ?? '-' }}
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
        </div>
    </div>
</x-app-layout>
