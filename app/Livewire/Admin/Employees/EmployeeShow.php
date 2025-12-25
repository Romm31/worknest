<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use Livewire\Component;

class EmployeeShow extends Component
{
    public Employee $employee;

    public function mount(Employee $employee)
    {
        $this->employee = $employee->load([
            'user',
            'department',
            'position',
            'attendances' => function ($query) {
                $query->orderBy('attendance_date', 'desc')->limit(10);
            },
            'leaveRequests' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(5);
            }
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        return view('livewire.admin.employees.employee-show')
            ->layout('layouts.app', [
                'sidebar' => view('components.admin-sidebar'),
                'header' => 'Employee Details',
            ]);
    }
}
