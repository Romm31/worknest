<?php

namespace App\Livewire\Employee\Attendance;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class AttendanceHistory extends Component
{
    use WithPagination;

    public string $filterMonth = '';

    public function mount(): void
    {
        $this->filterMonth = Carbon::now()->format('Y-m');
    }

    public function render(): View
    {
        $employee = auth()->user()->employee;

        $attendances = Attendance::where('employee_id', $employee->id)
            ->when($this->filterMonth, function ($query) {
                $date = Carbon::parse($this->filterMonth . '-01');
                $query->whereMonth('attendance_date', $date->month)
                    ->whereYear('attendance_date', $date->year);
            })
            ->orderBy('attendance_date', 'desc')
            ->paginate(15);

        // Calculate monthly stats
        $monthStats = null;
        if ($this->filterMonth) {
            $date = Carbon::parse($this->filterMonth . '-01');
            $monthAttendances = Attendance::where('employee_id', $employee->id)
                ->whereMonth('attendance_date', $date->month)
                ->whereYear('attendance_date', $date->year)
                ->get();

            $monthStats = [
                'totalDays' => $monthAttendances->count(),
                'lateDays' => $monthAttendances->filter(fn($a) => $a->isLate())->count(),
                'totalHours' => $monthAttendances->sum(fn($a) => $a->workingHours ?? 0),
            ];
        }

        return view('livewire.employee.attendance.attendance-history', [
            'attendances' => $attendances,
            'monthStats' => $monthStats,
            'sidebar' => view('components.employee-sidebar')->render(),
            'header' => 'Attendance History',
        ]);
    }
}
