<?php

namespace App\Livewire\Employee;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EmployeeDashboard extends Component
{
    public function render(): View
    {
        $employee = auth()->user()->employee;

        if (!$employee) {
            return view('livewire.employee.no-profile', [
                'sidebar' => view('components.employee-sidebar')->render(),
                'header' => 'Dashboard',
            ]);
        }

        // Today's attendance
        $todayAttendance = $employee->todayAttendance;

        // This month's attendance count
        $monthlyAttendance = Attendance::where('employee_id', $employee->id)
            ->thisMonth()
            ->count();

        // Pending leave requests
        $pendingLeaveRequests = LeaveRequest::where('employee_id', $employee->id)
            ->pending()
            ->count();

        // Recent attendance (last 7 days)
        $recentAttendance = Attendance::where('employee_id', $employee->id)
            ->orderBy('attendance_date', 'desc')
            ->limit(7)
            ->get();

        // Recent leave requests
        $recentLeaveRequests = LeaveRequest::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('livewire.employee.employee-dashboard', [
            'employee' => $employee,
            'todayAttendance' => $todayAttendance,
            'monthlyAttendance' => $monthlyAttendance,
            'pendingLeaveRequests' => $pendingLeaveRequests,
            'recentAttendance' => $recentAttendance,
            'recentLeaveRequests' => $recentLeaveRequests,
            'sidebar' => view('components.employee-sidebar')->render(),
            'header' => 'Dashboard',
        ]);
    }
}
