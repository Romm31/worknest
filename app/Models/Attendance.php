<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * @property Carbon $attendance_date
 * @property Carbon|null $check_in
 * @property Carbon|null $check_out
 */
class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'check_in',
        'check_out',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'attendance_date' => 'date',
            'check_in' => 'datetime',
            'check_out' => 'datetime',
        ];
    }

    /**
     * Get the employee this attendance belongs to
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Scope a query to filter by date range
     */
    public function scopeDateBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('attendance_date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to filter by today
     */
    public function scopeToday($query)
    {
        return $query->where('attendance_date', Carbon::today());
    }

    /**
     * Scope a query to filter by this week
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('attendance_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ]);
    }

    /**
     * Scope a query to filter by this month
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('attendance_date', Carbon::now()->month)
            ->whereYear('attendance_date', Carbon::now()->year);
    }

    /**
     * Get working hours for this attendance
     */
    public function getWorkingHoursAttribute(): ?float
    {
        if (!$this->check_in || !$this->check_out) {
            return null;
        }

        return round($this->check_in->diffInMinutes($this->check_out) / 60, 2);
    }

    /**
     * Get formatted check-in time
     */
    public function getCheckInTimeAttribute(): ?string
    {
        return $this->check_in?->format('H:i');
    }

    /**
     * Get formatted check-out time
     */
    public function getCheckOutTimeAttribute(): ?string
    {
        return $this->check_out?->format('H:i');
    }

    /**
     * Get attendance status
     */
    public function getStatusAttribute(): string
    {
        if (!$this->check_in) {
            return 'absent';
        }

        if (!$this->check_out) {
            return 'incomplete';
        }

        return 'complete';
    }

    /**
     * Check if check-in is late (after 9:00 AM)
     */
    public function isLate(string $lateThreshold = '09:00'): bool
    {
        if (!$this->check_in) {
            return false;
        }

        $threshold = Carbon::parse($this->attendance_date->format('Y-m-d') . ' ' . $lateThreshold);
        return $this->check_in->gt($threshold);
    }

    /**
     * Check if attendance is for today
     */
    public function isToday(): bool
    {
        return $this->attendance_date->isToday();
    }
}
