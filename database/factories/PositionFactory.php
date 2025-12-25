<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = [
            ['name' => 'Software Engineer', 'code' => 'SWE'],
            ['name' => 'Senior Software Engineer', 'code' => 'SSE'],
            ['name' => 'Project Manager', 'code' => 'PM'],
            ['name' => 'HR Manager', 'code' => 'HRM'],
            ['name' => 'Financial Analyst', 'code' => 'FA'],
            ['name' => 'Marketing Specialist', 'code' => 'MS'],
            ['name' => 'Sales Representative', 'code' => 'SR'],
            ['name' => 'Customer Support Specialist', 'code' => 'CSS'],
            ['name' => 'Team Lead', 'code' => 'TL'],
            ['name' => 'Department Head', 'code' => 'DH'],
            ['name' => 'Junior Developer', 'code' => 'JD'],
            ['name' => 'UI/UX Designer', 'code' => 'UXD'],
        ];

        $position = fake()->unique()->randomElement($positions);

        return [
            'name' => $position['name'],
            'code' => $position['code'],
            'description' => fake()->paragraph(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the position is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }
}
