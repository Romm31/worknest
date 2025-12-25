<?php

namespace App\Livewire\Admin\Attendances;

use App\Models\Attendance;
use App\Models\Department;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterDepartment = '';
    public string $filterDate = '';
    public string $filterMonth = '';

    public function mount(): void
    {
        $this->filterDate = Carbon::today()->format('Y-m-d');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'filterDepartment', 'filterMonth']);
        $this->filterDate = Carbon::today()->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
    {
        $attendances = Attendance::with(['employee.user', 'employee.department'])
            ->when($this->search, function ($query) {
                $query->whereHas('employee.user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('employee', function ($q) {
                    $q->where('employee_code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterDepartment, function ($query) {
                $query->whereHas('employee', function ($q) {
                    $q->where('department_id', $this->filterDepartment);
                });
            })
            ->when($this->filterDate, function ($query) {
                $query->whereDate('attendance_date', $this->filterDate);
            })
            ->when($this->filterMonth, function ($query) {
                $date = Carbon::parse($this->filterMonth);
                $query->whereMonth('attendance_date', $date->month)
                    ->whereYear('attendance_date', $date->year);
            })
            ->orderBy('attendance_date', 'desc')
            ->orderBy('check_in', 'desc')
            ->paginate(15);

        return view('livewire.admin.attendances.attendance-index', [
            'attendances' => $attendances,
            'departments' => Department::active()->get(),
        ])->layout('layouts.app', [
                    'sidebar' => view('components.admin-sidebar'),
                    'header' => 'Attendance Records',
                ]);
    }
}
