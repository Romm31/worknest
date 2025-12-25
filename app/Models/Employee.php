<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'position_id',
        'employee_code',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'hire_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'hire_date' => 'date',
        ];
    }

    /**
     * Get the user associated with this employee
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department this employee belongs to
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position of this employee
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get all attendance records for this employee
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get all leave requests for this employee
     */
    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    /**
     * Scope a query to only include active employees
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to filter by department
     */
    public function scopeInDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Get the employee's full name from user
     */
    public function getNameAttribute(): string
    {
        return $this->user->name ?? '';
    }

    /**
     * Get the employee's email from user
     */
    public function getEmailAttribute(): string
    {
        return $this->user->email ?? '';
    }

    /**
     * Get today's attendance record
     */
    public function getTodayAttendanceAttribute(): ?Attendance
    {
        return $this->attendances()
            ->where('attendance_date', Carbon::today())
            ->first();
    }

    /**
     * Check if employee has checked in today
     */
    public function getHasCheckedInTodayAttribute(): bool
    {
        return $this->todayAttendance?->check_in !== null;
    }

    /**
     * Check if employee has checked out today
     */
    public function getHasCheckedOutTodayAttribute(): bool
    {
        return $this->todayAttendance?->check_out !== null;
    }

    /**
     * Get pending leave requests count
     */
    public function getPendingLeaveRequestsCountAttribute(): int
    {
        return $this->leaveRequests()->where('status', 'pending')->count();
    }

    /**
     * Generate a unique employee code
     */
    public static function generateEmployeeCode(): string
    {
        $prefix = 'EMP';
        $year = date('Y');
        $lastEmployee = self::withTrashed()
            ->where('employee_code', 'like', "{$prefix}{$year}%")
            ->orderBy('employee_code', 'desc')
            ->first();

        if ($lastEmployee) {
            $lastNumber = (int) substr($lastEmployee->employee_code, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "{$prefix}{$year}{$newNumber}";
    }
}
