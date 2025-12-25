<?php

namespace App\Livewire\Admin\Employees;

use App\Models\ActivityLog;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDepartment = '';
    public $filterStatus = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;

    public $employeeId;
    public $name;
    public $email;
    public $password;
    public $department_id;
    public $position_id;
    public $phone;
    public $address;
    public $date_of_birth;
    public $gender;
    public $hire_date;
    public $status = 'active';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive,terminated',
        ];

        if ($this->editMode) {
            $employee = Employee::find($this->employeeId);
            $rules['email'] = 'required|email|unique:users,email,' . $employee?->user_id;
            $rules['password'] = 'nullable|string|min:8';
        } else {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['employeeId', 'name', 'email', 'password', 'department_id', 'position_id', 'phone', 'address', 'date_of_birth', 'gender', 'hire_date', 'status', 'editMode']);
        $this->status = 'active';
        $this->hire_date = now()->format('Y-m-d');
        $this->showModal = true;
    }

    public function edit($id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        $this->employeeId = $employee->id;
        $this->name = $employee->user->name;
        $this->email = $employee->user->email;
        $this->department_id = $employee->department_id;
        $this->position_id = $employee->position_id;
        $this->phone = $employee->phone;
        $this->address = $employee->address;
        $this->date_of_birth = $employee->date_of_birth?->format('Y-m-d');
        $this->gender = $employee->gender;
        $this->hire_date = $employee->hire_date->format('Y-m-d');
        $this->status = $employee->status;
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editMode) {
            $employee = Employee::with('user')->findOrFail($this->employeeId);
            $oldValues = $employee->toArray();

            // Update user
            $userData = [
                'name' => $this->name,
                'email' => $this->email,
            ];
            if ($this->password) {
                $userData['password'] = Hash::make($this->password);
            }
            $employee->user->update($userData);

            // Update employee
            $employee->update([
                'department_id' => $this->department_id,
                'position_id' => $this->position_id,
                'phone' => $this->phone,
                'address' => $this->address,
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender,
                'hire_date' => $this->hire_date,
                'status' => $this->status,
            ]);

            ActivityLog::log('updated', $employee, $oldValues, $employee->fresh()->toArray());
            session()->flash('success', 'Employee updated successfully.');
        } else {
            // Create user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'employee',
                'email_verified_at' => now(),
            ]);

            // Create employee
            $employee = Employee::create([
                'user_id' => $user->id,
                'department_id' => $this->department_id,
                'position_id' => $this->position_id,
                'employee_code' => Employee::generateEmployeeCode(),
                'phone' => $this->phone,
                'address' => $this->address,
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender,
                'hire_date' => $this->hire_date,
                'status' => $this->status,
            ]);

            ActivityLog::log('created', $employee);
            session()->flash('success', 'Employee created successfully.');
        }

        $this->reset(['showModal', 'employeeId', 'name', 'email', 'password', 'department_id', 'position_id', 'phone', 'address', 'date_of_birth', 'gender', 'hire_date', 'status', 'editMode']);
    }

    public function confirmDelete($id)
    {
        $this->employeeId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $employee = Employee::with('user')->findOrFail($this->employeeId);

        ActivityLog::log('deleted', $employee, $employee->toArray());

        $employee->user->delete();
        $employee->delete();

        session()->flash('success', 'Employee deleted successfully.');
        $this->showDeleteModal = false;
        $this->employeeId = null;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        $employees = Employee::with(['user', 'department', 'position'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })->orWhere('employee_code', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterDepartment, function ($query) {
                $query->where('department_id', $this->filterDepartment);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.employees.employee-index', [
            'employees' => $employees,
            'departments' => Department::active()->get(),
            'positions' => Position::active()->get(),
        ])->layout('layouts.app', [
                    'sidebar' => view('components.admin-sidebar'),
                    'header' => 'Employees',
                ]);
    }
}
