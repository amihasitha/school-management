<aside class="w-64 shrink-0 bg-[#0F5C33] text-white" style="width: 310px;">
    <div class="border-b border-white/20 px-6 py-5 p-2">
        <h3 class="text-lg font-bold">
            {{ __('St. John\'s College') }}
        </h3>
        <p class="mt-1 text-sm text-green-100">
            {{ __('Data Management System') }}
        </p>
    </div>

    <nav class="mt-4 px-3 space-y-2">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 rounded-md px-4 py-3
            hover:bg-white/10 transition
            {{ request()->routeIs('dashboard') ? 'bg-white/20 font-semibold' : '' }}">
            <span>🏠</span>
            <span>{{ __('Dashboard') }}</span>
        </a>
        <a href="{{ route('profile.edit') }}"
        class="flex items-center gap-3 rounded-md px-4 py-3">
            <span>👤</span>
            <span>{{ __('Profile') }}</span>
        </a>

        {{-- Super Admin Links --}}
        @if (auth()->user()->user_type === 'super_admin')

            <p class="px-4 pt-5 pb-2 text-xs uppercase
                        tracking-wider text-green-200 p-2">
                {{ __('User Management') }}
            </p>

            <a href="{{ route('teachers.index') }}"
                class="flex items-center gap-3 rounded-md px-4 py-3
                hover:bg-white/10 transition
                {{ request()->routeIs('teachers.*') ? 'bg-white/20 font-semibold' : '' }}">
                <span>👨‍🏫</span>
                <span>{{ __('View All Teachers') }}</span>
            </a>

            <a href="{{ route('students.index') }}"
                class="flex items-center gap-3 rounded-md px-4 py-3
                hover:bg-white/10 transition
                {{ request()->routeIs('students.*') ? 'bg-white/20 font-semibold' : '' }}">
                <span>🎓</span>
                <span>{{ __('View All Students') }}</span>
            </a>

        @endif

            <p class="px-4 pt-5 pb-2 text-xs uppercase
                        tracking-wider text-green-200 p-2">
                {{ __('Import Data') }}
            </p>
            <a href="{{ route('teachers.import') }}"
                class="flex items-center gap-3 rounded-md px-4 py-3
                hover:bg-white/10 transition
                {{ request()->routeIs('teachers.import') ? 'bg-white/20 font-semibold' : '' }}">
                <span>📥</span>
                <span>{{ __('Import Teachers') }}</span>
            </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex w-full items-center gap-3 rounded-md px-4 py-3
                        text-left hover:bg-white/10 transition">
                <span>🚪</span>
                <span>{{ __('Logout') }}</span>
            </button>
        </form>
    </nav>
</aside>