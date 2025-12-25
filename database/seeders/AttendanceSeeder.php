<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        // Generate attendance for the last 30 days (weekdays only)
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now()->subDay(); // Don't include today

        foreach ($employees as $employee) {
            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                // Skip weekends
                if (!$currentDate->isWeekend()) {
                    // 90% chance of attendance
                    if (fake()->boolean(90)) {
                        // Generate random check-in time between 7:30 and 9:30
                        $checkInHour = fake()->numberBetween(7, 9);
                        $checkInMinute = fake()->numberBetween(0, 59);

                        // 15% chance of being late (after 9:00)
                        if (fake()->boolean(15)) {
                            $checkInHour = fake()->numberBetween(9, 10);
                            $checkInMinute = fake()->numberBetween(15, 59);
                        }

                        $checkIn = $currentDate->copy()->setTime($checkInHour, $checkInMinute);

                        // Generate check-out time (8-10 hours after check-in)
                        $workHours = fake()->numberBetween(8, 10);
                        $checkOut = $checkIn->copy()->addHours($workHours)->addMinutes(fake()->numberBetween(0, 30));

                        Attendance::create([
                            'employee_id' => $employee->id,
                            'attendance_date' => $currentDate->copy(),
                            'check_in' => $checkIn,
                            'check_out' => $checkOut,
                            'notes' => fake()->optional(0.1)->randomElement([
                                'Working from home',
                                'Client meeting in the morning',
                                'Training session',
                                'Team building activity',
                            ]),
                        ]);
                    }
                }

                $currentDate->addDay();
            }
        }
    }
}
