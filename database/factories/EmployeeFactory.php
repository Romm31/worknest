<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'department_id' => Department::factory(),
            'position_id' => Position::factory(),
            'employee_code' => Employee::generateEmployeeCode(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-20 years'),
            'gender' => fake()->randomElement(['male', 'female']),
            'hire_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'status' => 'active',
        ];
    }

    /**
     * Indicate that the employee is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'inactive',
        ]);
    }

    /**
     * Indicate that the employee is terminated.
     */
    public function terminated(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'terminated',
        ]);
    }

    /**
     * Use an existing user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn(array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Use an existing department.
     */
    public function inDepartment(Department $department): static
    {
        return $this->state(fn(array $attributes) => [
            'department_id' => $department->id,
        ]);
    }

    /**
     * Use an existing position.
     */
    public function withPosition(Position $position): static
    {
        return $this->state(fn(array $attributes) => [
            'position_id' => $position->id,
        ]);
    }
}
