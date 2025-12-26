<?php

use Illuminate\Support\Facades\Route;

// Livewire Admin Components
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\Departments\DepartmentIndex;
use App\Livewire\Admin\Positions\PositionIndex;
use App\Livewire\Admin\Employees\EmployeeIndex;
use App\Livewire\Admin\Employees\EmployeeShow;
use App\Livewire\Admin\Attendances\AttendanceIndex;
use App\Livewire\Admin\LeaveRequests\LeaveRequestIndex;
use App\Livewire\Admin\ActivityLogs\ActivityLogIndex;

// Livewire Employee Components
use App\Livewire\Employee\EmployeeDashboard;
use App\Livewire\Employee\Attendance\AttendancePanel;
use App\Livewire\Employee\Attendance\AttendanceHistory;
use App\Livewire\Employee\Leave\LeaveRequestPanel;
use App\Livewire\Employee\Profile\EmployeeProfile;

// Settings Components
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;

use Laravel\Fortify\Features;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('employee.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

        // Departments
        Route::get('/departments', DepartmentIndex::class)->name('departments.index');

        // Positions
        Route::get('/positions', PositionIndex::class)->name('positions.index');

        // Employees
        Route::get('/employees', EmployeeIndex::class)->name('employees.index');
        Route::get('/employees/{employee}', EmployeeShow::class)->name('employees.show');

        // Attendance
        Route::get('/attendances', AttendanceIndex::class)->name('attendances.index');

        // Leave Requests
        Route::get('/leave-requests', LeaveRequestIndex::class)->name('leave-requests.index');

        // Activity Logs
        Route::get('/activity-logs', ActivityLogIndex::class)->name('activity-logs.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Employee Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['employee'])->prefix('employee')->name('employee.')->group(function () {

        // Dashboard
        Route::get('/dashboard', EmployeeDashboard::class)->name('dashboard');

        // Attendance
        Route::get('/attendance', AttendancePanel::class)->name('attendance.index');
        Route::get('/attendance/history', AttendanceHistory::class)->name('attendance.history');

        // Leave Requests
        Route::get('/leave', LeaveRequestPanel::class)->name('leave.index');

        // Profile
        Route::get('/profile', EmployeeProfile::class)->name('profile.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
