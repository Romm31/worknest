<div>
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 flex-1">
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or code..." class="form-input pl-10">
            </div>
            <select wire:model.live="filterDepartment" class="form-select">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
            <input type="date" wire:model.live="filterDate" class="form-input">
        </div>
        <button wire:click="clearFilters" class="btn-ghost text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Reset Filters
        </button>
    </div>

    <!-- Table -->
    <x-ui.card :padding="false">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Working Hours</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                        <span class="text-sm font-semibold text-primary-700 dark:text-indigo-300">{{ $attendance->employee->user->initials() }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $attendance->employee->user->name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $attendance->employee->department->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-slate-900 dark:text-zinc-100">{{ $attendance->attendance_date->format('M d, Y') }}</p>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $attendance->attendance_date->format('l') }}</p>
                            </td>
                            <td>
                                @if($attendance->check_in)
                                    <span class="font-mono text-sm {{ $attendance->isLate() ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                                        {{ $attendance->checkInTime }}
                                    </span>
                                    @if($attendance->isLate())
                                        <span class="text-xs text-red-500 ml-1">(Late)</span>
                                    @endif
                                @else
                                    <span class="text-slate-400">--:--</span>
                                @endif
                            </td>
                            <td>
                                <span class="font-mono text-sm {{ $attendance->check_out ? 'text-slate-900 dark:text-zinc-100' : 'text-slate-400' }}">
                                    {{ $attendance->checkOutTime ?? '--:--' }}
                                </span>
                            </td>
                            <td>
                                @if($attendance->workingHours)
                                    <span class="text-slate-900 dark:text-zinc-100">{{ $attendance->workingHours }} hrs</span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td>
                                @switch($attendance->status)
                                    @case('complete')
                                        <x-ui.badge type="success">Complete</x-ui.badge>
                                        @break
                                    @case('incomplete')
                                        <x-ui.badge type="warning">Incomplete</x-ui.badge>
                                        @break
                                    @case('absent')
                                        <x-ui.badge type="danger">Absent</x-ui.badge>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <x-ui.empty-state title="No attendance records" description="No attendance records found for the selected filters." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($attendances->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700">{{ $attendances->links() }}</div>
        @endif
    </x-ui.card>
</div>
