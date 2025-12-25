<!-- Employee Sidebar Navigation -->
<div class="space-y-1">
    <p class="px-4 text-xs font-semibold text-slate-400 dark:text-zinc-500 uppercase tracking-wider mb-2">Main</p>

    <x-sidebar-link href="{{ route('employee.dashboard') }}" :active="request()->routeIs('employee.dashboard')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Dashboard
    </x-sidebar-link>
</div>

<div class="space-y-1 mt-6">
    <p class="px-4 text-xs font-semibold text-slate-400 dark:text-zinc-500 uppercase tracking-wider mb-2">Attendance</p>

    <x-sidebar-link href="{{ route('employee.attendance.index') }}"
        :active="request()->routeIs('employee.attendance.*')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Check In / Out
    </x-sidebar-link>

    <x-sidebar-link href="{{ route('employee.attendance.history') }}"
        :active="request()->routeIs('employee.attendance.history')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Attendance History
    </x-sidebar-link>
</div>

<div class="space-y-1 mt-6">
    <p class="px-4 text-xs font-semibold text-slate-400 dark:text-zinc-500 uppercase tracking-wider mb-2">Leave</p>

    <x-sidebar-link href="{{ route('employee.leave.index') }}" :active="request()->routeIs('employee.leave.*')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Leave Requests
    </x-sidebar-link>
</div>

<div class="space-y-1 mt-6">
    <p class="px-4 text-xs font-semibold text-slate-400 dark:text-zinc-500 uppercase tracking-wider mb-2">Profile</p>

    <x-sidebar-link href="{{ route('employee.profile.index') }}" :active="request()->routeIs('employee.profile.*')">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        My Profile
    </x-sidebar-link>
</div>