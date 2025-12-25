<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $admin = User::where('role', 'admin')->first();

        foreach ($employees as $employee) {
            // Create 1-3 leave requests per employee
            $requestCount = fake()->numberBetween(1, 3);

            for ($i = 0; $i < $requestCount; $i++) {
                $type = fake()->randomElement(['sick', 'vacation', 'personal', 'other']);
                $status = fake()->randomElement(['pending', 'approved', 'rejected']);

                // Generate dates
                if ($status === 'pending') {
                    // Pending requests are for future dates
                    $startDate = Carbon::now()->addDays(fake()->numberBetween(5, 30));
                } else {
                    // Past or near-future dates for processed requests
                    $startDate = Carbon::now()->addDays(fake()->numberBetween(-30, 15));
                }

                $endDate = $startDate->copy()->addDays(fake()->numberBetween(1, 5));

                $reasons = [
                    'sick' => [
                        'Not feeling well, need to rest.',
                        'Doctor appointment and recovery time.',
                        'Medical treatment required.',
                    ],
                    'vacation' => [
                        'Family vacation trip.',
                        'Personal travel plans.',
                        'Annual holiday break.',
                    ],
                    'personal' => [
                        'Personal matters to attend.',
                        'Family event.',
                        'Moving to a new house.',
                    ],
                    'other' => [
                        'Attending a conference.',
                        'Jury duty.',
                        'Educational workshop.',
                    ],
                ];

                $leaveData = [
                    'employee_id' => $employee->id,
                    'type' => $type,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'reason' => fake()->randomElement($reasons[$type]),
                    'status' => $status,
                ];

                if ($status === 'approved') {
                    $leaveData['approved_by'] = $admin?->id;
                    $leaveData['approved_at'] = $startDate->copy()->subDays(fake()->numberBetween(1, 5));
                } elseif ($status === 'rejected') {
                    $leaveData['approved_by'] = $admin?->id;
                    $leaveData['approved_at'] = $startDate->copy()->subDays(fake()->numberBetween(1, 5));
                    $leaveData['rejection_reason'] = fake()->randomElement([
                        'Insufficient leave balance.',
                        'Critical project deadline during this period.',
                        'Too many team members on leave.',
                        'Please reschedule to a different date.',
                    ]);
                }

                LeaveRequest::create($leaveData);
            }
        }

        // Ensure there are some pending requests for demo
        $demoEmployee = Employee::whereHas('user', function ($query) {
            $query->where('email', 'employee@worknest.com');
        })->first();

        if ($demoEmployee) {
            LeaveRequest::create([
                'employee_id' => $demoEmployee->id,
                'type' => 'vacation',
                'start_date' => Carbon::now()->addDays(14),
                'end_date' => Carbon::now()->addDays(18),
                'reason' => 'Planning a family vacation for the holidays.',
                'status' => 'pending',
            ]);
        }
    }
}
