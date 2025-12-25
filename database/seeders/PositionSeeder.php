<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Department Head',
                'code' => 'DH',
                'description' => 'Leads and manages an entire department.',
                'is_active' => true,
            ],
            [
                'name' => 'Team Lead',
                'code' => 'TL',
                'description' => 'Supervises and coordinates team activities.',
                'is_active' => true,
            ],
            [
                'name' => 'Senior Software Engineer',
                'code' => 'SSE',
                'description' => 'Experienced developer handling complex technical tasks.',
                'is_active' => true,
            ],
            [
                'name' => 'Software Engineer',
                'code' => 'SWE',
                'description' => 'Develops and maintains software applications.',
                'is_active' => true,
            ],
            [
                'name' => 'Junior Developer',
                'code' => 'JD',
                'description' => 'Entry-level developer learning and growing skills.',
                'is_active' => true,
            ],
            [
                'name' => 'HR Manager',
                'code' => 'HRM',
                'description' => 'Manages human resources operations and policies.',
                'is_active' => true,
            ],
            [
                'name' => 'HR Specialist',
                'code' => 'HRS',
                'description' => 'Handles specific HR functions like recruitment or benefits.',
                'is_active' => true,
            ],
            [
                'name' => 'Financial Analyst',
                'code' => 'FA',
                'description' => 'Analyzes financial data and prepares reports.',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing Specialist',
                'code' => 'MS',
                'description' => 'Executes marketing campaigns and strategies.',
                'is_active' => true,
            ],
            [
                'name' => 'Sales Representative',
                'code' => 'SR',
                'description' => 'Manages client relationships and drives sales.',
                'is_active' => true,
            ],
            [
                'name' => 'Operations Manager',
                'code' => 'OM',
                'description' => 'Oversees operational efficiency and processes.',
                'is_active' => true,
            ],
            [
                'name' => 'Customer Support Specialist',
                'code' => 'CSS',
                'description' => 'Provides customer assistance and resolves issues.',
                'is_active' => true,
            ],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
