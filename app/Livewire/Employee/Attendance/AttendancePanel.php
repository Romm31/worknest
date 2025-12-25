<?php

namespace App\Livewire\Employee\Attendance;

use App\Models\ActivityLog;
use App\Models\Attendance;
use Carbon\Carbon;
use Livewire\Component;

class AttendancePanel extends Component
{
    public function checkIn(): void
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            session()->flash('error', 'Employee profile not found.');
            return;
        }

        // Check if already checked in today
        if ($employee->hasCheckedInToday) {
            session()->flash('error', 'You have already checked in today.');
            return;
        }

        $attendance = Attendance::create([
            'employee_id' => $employee->id,
            'attendance_date' => Carbon::today(),
            'check_in' => Carbon::now(),
        ]);

        ActivityLog::log('check_in', $attendance);

        session()->flash('success', 'Successfully checked in at ' . Carbon::now()->format('H:i:s'));
    }

    public function checkOut(): void
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            session()->flash('error', 'Employee profile not found.');
            return;
        }

        $attendance = $employee->todayAttendance;

        if (!$attendance) {
            session()->flash('error', 'You have not checked in today.');
            return;
        }

        if ($attendance->check_out) {
            session()->flash('error', 'You have already checked out today.');
            return;
        }

        $attendance->update([
            'check_out' => Carbon::now(),
        ]);

        ActivityLog::log('check_out', $attendance);

        session()->flash('success', 'Successfully checked out at ' . Carbon::now()->format('H:i:s'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        $employee = auth()->user()->employee;
        $todayAttendance = $employee?->todayAttendance;
        $currentTime = Carbon::now();

        return view('livewire.employee.attendance.attendance-panel', [
            'employee' => $employee,
            'todayAttendance' => $todayAttendance,
            'currentTime' => $currentTime,
            'canCheckIn' => $employee && !$employee->hasCheckedInToday,
            'canCheckOut' => $employee && $employee->hasCheckedInToday && !$employee->hasCheckedOutToday,
        ])->layout('layouts.app', [
                    'sidebar' => view('components.employee-sidebar'),
                    'header' => 'Check In / Out',
                ]);
    }
}
