<?php

namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Livewire\Component;

class AdminDashboard extends Component
{
    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        // Statistics
        $totalEmployees = Employee::where('status', 'active')->count();
        $todayAttendance = Attendance::today()->count();
        $pendingLeaveRequests = LeaveRequest::pending()->count();
        $totalDepartments = \App\Models\Department::where('is_active', true)->count();

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
        ])->layout('layouts.app', [
                    'sidebar' => view('components.admin-sidebar'),
                    'header' => 'Dashboard',
                ]);
    }
}
