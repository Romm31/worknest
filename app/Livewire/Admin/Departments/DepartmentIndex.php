<?php

namespace App\Livewire\Admin\Departments;

use App\Models\ActivityLog;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;

    public $departmentId;
    public $name;
    public $code;
    public $description;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:departments,code',
        'description' => 'nullable|string|max:1000',
        'is_active' => 'boolean',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['departmentId', 'name', 'code', 'description', 'is_active', 'editMode']);
        $this->is_active = true;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $this->departmentId = $department->id;
        $this->name = $department->name;
        $this->code = $department->code;
        $this->description = $department->description;
        $this->is_active = $department->is_active;
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = $this->rules;

        if ($this->editMode) {
            $rules['code'] = 'required|string|max:10|unique:departments,code,' . $this->departmentId;
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'code' => strtoupper($this->code),
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        if ($this->editMode) {
            $department = Department::findOrFail($this->departmentId);
            $oldValues = $department->toArray();
            $department->update($data);

            ActivityLog::log('updated', $department, $oldValues, $department->fresh()->toArray());

            session()->flash('success', 'Department updated successfully.');
        } else {
            $department = Department::create($data);

            ActivityLog::log('created', $department);

            session()->flash('success', 'Department created successfully.');
        }

        $this->reset(['showModal', 'departmentId', 'name', 'code', 'description', 'is_active', 'editMode']);
    }

    public function confirmDelete($id)
    {
        $this->departmentId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $department = Department::findOrFail($this->departmentId);

        // Check if department has employees
        if ($department->employees()->count() > 0) {
            session()->flash('error', 'Cannot delete department with existing employees.');
            $this->showDeleteModal = false;
            return;
        }

        ActivityLog::log('deleted', $department, $department->toArray());

        $department->delete();

        session()->flash('success', 'Department deleted successfully.');
        $this->showDeleteModal = false;
        $this->departmentId = null;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        $departments = Department::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->withCount('employees')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.departments.department-index', [
            'departments' => $departments,
        ])->layout('layouts.app', [
                    'sidebar' => view('components.admin-sidebar'),
                    'header' => 'Departments',
                ]);
    }
}
