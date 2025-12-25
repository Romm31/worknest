<?php

namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AdminDashboard extends Component
{
    public function render(): View
    {
        // Statistics
        $totalEmployees = Employee::where('status', 'active')->count();
        $todayAttendance = Attendance::today()->count();
        $pendingLeaveRequests = LeaveRequest::pending()->count();
        $totalDepartments = Department::where('is_active', true)->count();

        // Calculate attendance rate
        $attendanceRate = $totalEmployees > 0
            ? round(($todayAttendance / $totalEmployees) * 100)
            : 0;

        // Recent activities
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Recent leave requests
        $recentLeaveRequests = LeaveRequest::with('employee.user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Monthly attendance data (last 7 days)
        $weeklyAttendance = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Attendance::whereDate('attendance_date', $date)->count();
            $weeklyAttendance->push([
                'date' => $date->format('D'),
                'count' => $count,
            ]);
        }

        return view('livewire.admin.admin-dashboard', [
            'totalEmployees' => $totalEmployees,
            'todayAttendance' => $todayAttendance,
            'pendingLeaveRequests' => $pendingLeaveRequests,
            'totalDepartments' => $totalDepartments,
            'attendanceRate' => $attendanceRate,
            'recentActivities' => $recentActivities,
            'recentLeaveRequests' => $recentLeaveRequests,
            'weeklyAttendance' => $weeklyAttendance,
            'sidebar' => view('components.admin-sidebar')->render(),
            'header' => 'Dashboard',
        ]);
    }
}
