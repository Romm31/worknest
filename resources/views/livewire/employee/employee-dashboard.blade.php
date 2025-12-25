<div>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-zinc-100">
            Welcome back, {{ auth()->user()->name }}!
        </h1>
        <p class="text-slate-500 dark:text-zinc-400">Here's your overview for today, {{ now()->format('l, F d, Y') }}
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Today's Status -->
        <x-ui.card>
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-lg flex items-center justify-center {{ $todayAttendance ? 'bg-green-100 dark:bg-green-900/50' : 'bg-slate-100 dark:bg-zinc-700' }}">
                    <svg class="w-6 h-6 {{ $todayAttendance ? 'text-green-600 dark:text-green-400' : 'text-slate-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Today's Status</p>
                    @if($todayAttendance)
                        <p class="text-lg font-semibold text-green-600 dark:text-green-400">Checked In</p>
                        <p class="text-xs text-slate-500 dark:text-zinc-400">at {{ $todayAttendance->checkInTime }}</p>
                    @else
                        <p class="text-lg font-semibold text-slate-900 dark:text-zinc-100">Not Checked In</p>
                    @endif
                </div>
            </div>
        </x-ui.card>

        <!-- Monthly Attendance -->
        <x-ui.stat-card title="This Month's Attendance" :value="$monthlyAttendance . ' days'"
            iconBg="bg-blue-100 dark:bg-blue-900/50" iconColor="text-blue-600 dark:text-blue-400"
            link="{{ route('employee.attendance.history') }}" linkText="View history">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </x-slot:icon>
        </x-ui.stat-card>

        <!-- Pending Leave Requests -->
        <x-ui.stat-card title="Pending Leave Requests" :value="$pendingLeaveRequests"
            iconBg="bg-yellow-100 dark:bg-yellow-900/50" iconColor="text-yellow-600 dark:text-yellow-400"
            link="{{ route('employee.leave.index') }}" linkText="View requests">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </x-slot:icon>
        </x-ui.stat-card>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('employee.attendance.index') }}" class="card p-6 hover:shadow-lg transition-shadow group">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-xl bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-primary-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">Check In / Out</h3>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Record your daily attendance</p>
                </div>
            </div>
        </a>

        <a href="{{ route('employee.leave.index') }}" class="card p-6 hover:shadow-lg transition-shadow group">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-xl bg-green-100 dark:bg-green-900/50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">Request Leave</h3>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Submit a new leave request</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Attendance -->
        <x-ui.card title="Recent Attendance">
            @if($recentAttendance->count() > 0)
                <div class="space-y-3">
                    @foreach($recentAttendance as $attendance)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 dark:bg-zinc-700/50">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">
                                    {{ $attendance->attendance_date->format('M d, Y') }}</p>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">
                                    {{ $attendance->attendance_date->format('l') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-mono text-slate-900 dark:text-zinc-100">
                                    {{ $attendance->checkInTime ?? '--:--' }} - {{ $attendance->checkOutTime ?? '--:--' }}
                                </p>
                                @if($attendance->workingHours)
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $attendance->workingHours }} hrs</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <x-ui.empty-state title="No attendance yet" description="Your attendance records will appear here." />
            @endif
        </x-ui.card>

        <!-- Recent Leave Requests -->
        <x-ui.card title="Recent Leave Requests">
            @if($recentLeaveRequests->count() > 0)
                <div class="space-y-3">
                    @foreach($recentLeaveRequests as $request)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 dark:bg-zinc-700/50">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $request->typeLabel }}</p>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">
                                    {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d') }}
                                </p>
                            </div>
                            <x-ui.badge :type="$request->statusColor">{{ $request->statusLabel }}</x-ui.badge>
                        </div>
                    @endforeach
                </div>
            @else
                <x-ui.empty-state title="No leave requests" description="Your leave requests will appear here." />
            @endif
        </x-ui.card>
    </div>
</div>