<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all departments and positions
        $departments = Department::all();
        $positions = Position::all();

        // Create Admin user (not an employee)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@worknest.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create sample employees
        $employees = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@worknest.com',
                'department' => 'IT',
                'position' => 'SSE',
                'gender' => 'male',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@worknest.com',
                'department' => 'HR',
                'position' => 'HRM',
                'gender' => 'female',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@worknest.com',
                'department' => 'FIN',
                'position' => 'FA',
                'gender' => 'male',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@worknest.com',
                'department' => 'MKT',
                'position' => 'MS',
                'gender' => 'female',
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@worknest.com',
                'department' => 'SLS',
                'position' => 'SR',
                'gender' => 'male',
            ],
            [
                'name' => 'Jessica Martinez',
                'email' => 'jessica.martinez@worknest.com',
                'department' => 'IT',
                'position' => 'SWE',
                'gender' => 'female',
            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'robert.taylor@worknest.com',
                'department' => 'OPS',
                'position' => 'OM',
                'gender' => 'male',
            ],
            [
                'name' => 'Amanda White',
                'email' => 'amanda.white@worknest.com',
                'department' => 'IT',
                'position' => 'JD',
                'gender' => 'female',
            ],
            [
                'name' => 'James Anderson',
                'email' => 'james.anderson@worknest.com',
                'department' => 'IT',
                'position' => 'TL',
                'gender' => 'male',
            ],
            [
                'name' => 'Lisa Thompson',
                'email' => 'lisa.thompson@worknest.com',
                'department' => 'HR',
                'position' => 'HRS',
                'gender' => 'female',
            ],
        ];

        foreach ($employees as $index => $employeeData) {
            // Create user account
            $user = User::create([
                'name' => $employeeData['name'],
                'email' => $employeeData['email'],
                'password' => Hash::make('password'),
                'role' => 'employee',
                'email_verified_at' => now(),
            ]);

            // Get department and position
            $department = $departments->where('code', $employeeData['department'])->first();
            $position = $positions->where('code', $employeeData['position'])->first();

            // Create employee profile
            Employee::create([
                'user_id' => $user->id,
                'department_id' => $department->id,
                'position_id' => $position->id,
                'employee_code' => Employee::generateEmployeeCode(),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'date_of_birth' => fake()->dateTimeBetween('-50 years', '-22 years'),
                'gender' => $employeeData['gender'],
                'hire_date' => fake()->dateTimeBetween('-3 years', '-1 month'),
                'status' => 'active',
            ]);
        }

        // Create the demo employee
        $demoUser = User::create([
            'name' => 'Demo Employee',
            'email' => 'employee@worknest.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'email_verified_at' => now(),
        ]);

        $itDept = $departments->where('code', 'IT')->first();
        $swePosition = $positions->where('code', 'SWE')->first();

        Employee::create([
            'user_id' => $demoUser->id,
            'department_id' => $itDept->id,
            'position_id' => $swePosition->id,
            'employee_code' => Employee::generateEmployeeCode(),
            'phone' => '(555) 123-4567',
            'address' => '123 Main Street, Tech City, TC 12345',
            'date_of_birth' => '1990-05-15',
            'gender' => 'male',
            'hire_date' => now()->subYear(),
            'status' => 'active',
        ]);
    }
}
