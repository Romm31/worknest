<div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Employees -->
        <x-ui.stat-card 
            title="Total Employees" 
            :value="$totalEmployees"
            link="{{ route('admin.employees.index') }}"
            linkText="View all employees"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </x-slot:icon>
        </x-ui.stat-card>

        <!-- Today's Attendance -->
        <x-ui.stat-card 
            title="Today's Attendance" 
            :value="$todayAttendance"
            :change="$attendanceRate . '% attendance rate'"
            changeType="neutral"
            link="{{ route('admin.attendances.index') }}"
            linkText="View attendance"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </x-slot:icon>
        </x-ui.stat-card>

        <!-- Pending Leave Requests -->
        <x-ui.stat-card 
            title="Pending Requests" 
            :value="$pendingLeaveRequests"
            iconBg="bg-yellow-100 dark:bg-yellow-900/50"
            iconColor="text-yellow-600 dark:text-yellow-400"
            link="{{ route('admin.leave-requests.index') }}"
            linkText="Review requests"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot:icon>
        </x-ui.stat-card>

        <!-- Departments -->
        <x-ui.stat-card 
            title="Departments" 
            :value="$totalDepartments"
            iconBg="bg-green-100 dark:bg-green-900/50"
            iconColor="text-green-600 dark:text-green-400"
            link="{{ route('admin.departments.index') }}"
            linkText="Manage departments"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </x-slot:icon>
        </x-ui.stat-card>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Weekly Attendance Chart -->
        <div class="lg:col-span-2">
            <x-ui.card title="Weekly Attendance Overview">
                <div class="flex items-end justify-between h-64 pt-4">
                    @foreach($weeklyAttendance as $day)
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-full px-2">
                                <div 
                                    class="bg-primary-500 dark:bg-indigo-500 rounded-t-lg mx-auto transition-all duration-500 hover:bg-primary-600 dark:hover:bg-indigo-400"
                                    style="height: {{ max(20, ($day['count'] / max($totalEmployees, 1)) * 150) }}px; width: 100%; max-width: 40px;"
                                ></div>
                            </div>
                            <span class="text-xs text-slate-500 dark:text-zinc-400 mt-2">{{ $day['date'] }}</span>
                            <span class="text-xs font-medium text-slate-700 dark:text-zinc-300">{{ $day['count'] }}</span>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>

        <!-- Recent Leave Requests -->
        <div class="lg:col-span-1">
            <x-ui.card title="Recent Leave Requests">
                @if($recentLeaveRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentLeaveRequests as $request)
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-slate-50 dark:bg-zinc-700/50">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-primary-700 dark:text-indigo-300">
                                        {{ $request->employee->user->initials() }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-900 dark:text-zinc-100 truncate">
                                        {{ $request->employee->user->name }}
                                    </p>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">
                                        {{ $request->typeLabel }} • {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d') }}
                                    </p>
                                </div>
                                <x-ui.badge :type="$request->statusColor">
                                    {{ $request->statusLabel }}
                                </x-ui.badge>
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-ui.empty-state 
                        title="No leave requests"
                        description="There are no recent leave requests."
                    />
                @endif
            </x-ui.card>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-6">
        <x-ui.card title="Recent Activity">
            @if($recentActivities->count() > 0)
                <div class="divide-y divide-slate-200 dark:divide-zinc-700">
                    @foreach($recentActivities as $activity)
                        <div class="py-3 flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                                @switch($activity->action)
                                    @case('created')
                                        bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400
                                        @break
                                    @case('updated')
                                        bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400
                                        @break
                                    @case('deleted')
                                        bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400
                                        @break
                                    @case('login')
                                        bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400
                                        @break
                                    @case('check_in')
                                    @case('check_out')
                                        bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400
                                        @break
                                    @default
                                        bg-slate-100 dark:bg-zinc-700 text-slate-600 dark:text-zinc-400
                                @endswitch
                            ">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @switch($activity->action)
                                        @case('created')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            @break
                                        @case('updated')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            @break
                                        @case('deleted')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            @break
                                        @case('login')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                            @break
                                        @default
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    @endswitch
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-slate-900 dark:text-zinc-100">
                                    <span class="font-medium">{{ $activity->user?->name ?? 'System' }}</span>
                                    {{ $activity->actionLabel }}
                                    @if($activity->modelName)
                                        <span class="text-slate-500 dark:text-zinc-400">{{ $activity->modelName }}</span>
                                    @endif
                                </p>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <x-ui.empty-state 
                    title="No recent activity"
                    description="Activity will appear here as users interact with the system."
                />
            @endif
        </x-ui.card>
    </div>
</div>
