<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EmployeeShow extends Component
{
    public Employee $employee;

    public function mount(Employee $employee): void
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

    public function render(): View
    {
        return view('livewire.admin.employees.employee-show', [
            'sidebar' => view('components.admin-sidebar')->render(),
            'header' => 'Employee Details',
        ]);
    }
}
