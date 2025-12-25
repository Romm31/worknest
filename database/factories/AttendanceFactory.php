<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-30 days', 'now');
        $checkIn = Carbon::parse($date)->setTime(
            fake()->numberBetween(7, 9),
            fake()->numberBetween(0, 59)
        );
        $checkOut = (clone $checkIn)->addHours(fake()->numberBetween(8, 10));

        return [
            'employee_id' => Employee::factory(),
            'attendance_date' => $date,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'notes' => fake()->optional(0.2)->sentence(),
        ];
    }

    /**
     * Create attendance for today.
     */
    public function today(): static
    {
        return $this->state(function (array $attributes) {
            $checkIn = Carbon::today()->setTime(
                fake()->numberBetween(7, 9),
                fake()->numberBetween(0, 59)
            );

            return [
                'attendance_date' => Carbon::today(),
                'check_in' => $checkIn,
                'check_out' => null,
            ];
        });
    }

    /**
     * Create completed attendance.
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            $date = $attributes['attendance_date'] ?? fake()->dateTimeBetween('-30 days', '-1 day');
            $checkIn = Carbon::parse($date)->setTime(
                fake()->numberBetween(7, 9),
                fake()->numberBetween(0, 59)
            );
            $checkOut = (clone $checkIn)->addHours(fake()->numberBetween(8, 10));

            return [
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ];
        });
    }

    /**
     * Create attendance with only check-in (incomplete).
     */
    public function incomplete(): static
    {
        return $this->state(fn(array $attributes) => [
            'check_out' => null,
        ]);
    }

    /**
     * Create late attendance.
     */
    public function late(): static
    {
        return $this->state(function (array $attributes) {
            $date = $attributes['attendance_date'] ?? Carbon::today();
            $checkIn = Carbon::parse($date)->setTime(
                fake()->numberBetween(9, 11),
                fake()->numberBetween(15, 59)
            );

            return [
                'check_in' => $checkIn,
            ];
        });
    }

    /**
     * Set specific date.
     */
    public function forDate(Carbon|string $date): static
    {
        return $this->state(fn(array $attributes) => [
            'attendance_date' => Carbon::parse($date),
        ]);
    }

    /**
     * Set specific employee.
     */
    public function forEmployee(Employee $employee): static
    {
        return $this->state(fn(array $attributes) => [
            'employee_id' => $employee->id,
        ]);
    }
}
