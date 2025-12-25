<div>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-700 dark:text-zinc-400 dark:hover:text-zinc-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Employees
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <x-ui.card>
                <div class="text-center">
                    <div class="w-24 h-24 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold text-primary-700 dark:text-indigo-300">{{ $employee->user->initials() }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-zinc-100">{{ $employee->user->name }}</h2>
                    <p class="text-sm text-slate-500 dark:text-zinc-400 mb-2">{{ $employee->position->name }}</p>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">{{ $employee->department->name }}</p>
                    
                    <div class="mt-4">
                        @switch($employee->status)
                            @case('active')
                                <x-ui.badge type="success" size="lg">Active</x-ui.badge>
                                @break
                            @case('inactive')
                                <x-ui.badge type="warning" size="lg">Inactive</x-ui.badge>
                                @break
                            @case('terminated')
                                <x-ui.badge type="danger" size="lg">Terminated</x-ui.badge>
                                @break
                        @endswitch
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-200 dark:border-zinc-700 space-y-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0" />
                        </svg>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Employee Code</p>
                            <p class="font-mono text-sm text-slate-900 dark:text-zinc-100">{{ $employee->employee_code }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Email</p>
                            <p class="text-sm text-slate-900 dark:text-zinc-100">{{ $employee->user->email }}</p>
                        </div>
                    </div>
                    @if($employee->phone)
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Phone</p>
                            <p class="text-sm text-slate-900 dark:text-zinc-100">{{ $employee->phone }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Hire Date</p>
                            <p class="text-sm text-slate-900 dark:text-zinc-100">{{ $employee->hire_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Recent Attendance -->
            <x-ui.card title="Recent Attendance">
                @if($employee->attendances->count() > 0)
                    <div class="space-y-3">
                        @foreach($employee->attendances as $attendance)
                            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 dark:bg-zinc-700/50">
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $attendance->attendance_date->format('M d, Y') }}</p>
                                    <p class="text-sm text-slate-500 dark:text-zinc-400">{{ $attendance->attendance_date->format('l') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-slate-900 dark:text-zinc-100">
                                        {{ $attendance->checkInTime ?? '--:--' }} - {{ $attendance->checkOutTime ?? '--:--' }}
                                    </p>
                                    @if($attendance->workingHours)
                                        <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $attendance->workingHours }} hours</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-ui.empty-state title="No attendance records" description="This employee has no attendance records yet." />
                @endif
            </x-ui.card>

            <!-- Recent Leave Requests -->
            <x-ui.card title="Recent Leave Requests">
                @if($employee->leaveRequests->count() > 0)
                    <div class="space-y-3">
                        @foreach($employee->leaveRequests as $request)
                            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 dark:bg-zinc-700/50">
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $request->typeLabel }}</p>
                                    <p class="text-sm text-slate-500 dark:text-zinc-400">
                                        {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}
                                    </p>
                                </div>
                                <x-ui.badge :type="$request->statusColor">{{ $request->statusLabel }}</x-ui.badge>
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-ui.empty-state title="No leave requests" description="This employee has no leave requests yet." />
                @endif
            </x-ui.card>
        </div>
    </div>
</div>
