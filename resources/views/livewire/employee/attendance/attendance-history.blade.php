<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <input type="month" wire:model.live="filterMonth" class="form-input">
        </div>
    </div>

    <!-- Month Stats -->
    @if($monthStats)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <x-ui.card class="text-center">
                <p class="text-sm text-slate-500 dark:text-zinc-400">Days Present</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-zinc-100">{{ $monthStats['totalDays'] }}</p>
            </x-ui.card>
            <x-ui.card class="text-center">
                <p class="text-sm text-slate-500 dark:text-zinc-400">Late Arrivals</p>
                <p class="text-3xl font-bold {{ $monthStats['lateDays'] > 0 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">{{ $monthStats['lateDays'] }}</p>
            </x-ui.card>
            <x-ui.card class="text-center">
                <p class="text-sm text-slate-500 dark:text-zinc-400">Total Hours</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-zinc-100">{{ number_format($monthStats['totalHours'], 1) }}</p>
            </x-ui.card>
        </div>
    @endif

    <!-- Table -->
    <x-ui.card :padding="false">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Hours</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td class="font-medium">{{ $attendance->attendance_date->format('M d, Y') }}</td>
                            <td class="text-slate-500 dark:text-zinc-400">{{ $attendance->attendance_date->format('l') }}</td>
                            <td>
                                <span class="font-mono {{ $attendance->isLate() ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                                    {{ $attendance->checkInTime }}
                                </span>
                                @if($attendance->isLate())
                                    <span class="text-xs text-red-500 ml-1">(Late)</span>
                                @endif
                            </td>
                            <td class="font-mono">{{ $attendance->checkOutTime ?? '--:--' }}</td>
                            <td>{{ $attendance->workingHours ? $attendance->workingHours . ' hrs' : '-' }}</td>
                            <td>
                                @switch($attendance->status)
                                    @case('complete')
                                        <x-ui.badge type="success">Complete</x-ui.badge>
                                        @break
                                    @case('incomplete')
                                        <x-ui.badge type="warning">Incomplete</x-ui.badge>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <x-ui.empty-state title="No records found" description="No attendance records for the selected month." />
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
