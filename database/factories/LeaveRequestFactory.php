<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    protected $model = LeaveRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+30 days');
        $endDate = Carbon::parse($startDate)->addDays(fake()->numberBetween(1, 5));

        return [
            'employee_id' => Employee::factory(),
            'type' => fake()->randomElement(['sick', 'vacation', 'personal', 'other']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reason' => fake()->paragraph(),
            'status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
            'rejection_reason' => null,
        ];
    }

    /**
     * Create pending leave request.
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
            'rejection_reason' => null,
        ]);
    }

    /**
     * Create approved leave request.
     */
    public function approved(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'approved',
            'approved_by' => User::factory()->state(['role' => 'admin']),
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);
    }

    /**
     * Create rejected leave request.
     */
    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rejected',
            'approved_by' => User::factory()->state(['role' => 'admin']),
            'approved_at' => now(),
            'rejection_reason' => fake()->sentence(),
        ]);
    }

    /**
     * Create sick leave.
     */
    public function sick(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'sick',
            'reason' => 'Not feeling well, need rest.',
        ]);
    }

    /**
     * Create vacation leave.
     */
    public function vacation(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'vacation',
            'reason' => 'Family vacation trip.',
        ]);
    }

    /**
     * Create personal leave.
     */
    public function personal(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'personal',
            'reason' => 'Personal matters to attend.',
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
