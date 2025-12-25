<?php

namespace App\Livewire\Employee\Leave;

use App\Models\ActivityLog;
use App\Models\LeaveRequest;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class LeaveRequestPanel extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public bool $showDeleteModal = false;

    public string $type = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $reason = '';

    public ?int $deleteId = null;

    protected array $rules = [
        'type' => 'required|in:sick,vacation,personal,other',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'reason' => 'required|string|min:10|max:1000',
    ];

    public function openModal(): void
    {
        $this->reset(['type', 'start_date', 'end_date', 'reason']);
        $this->showModal = true;
    }

    public function submit(): void
    {
        $this->validate();

        $employee = auth()->user()->employee;

        // Check for overlapping requests
        if (LeaveRequest::hasOverlappingRequest($employee->id, $this->start_date, $this->end_date)) {
            session()->flash('error', 'You already have a leave request for these dates.');
            $this->showModal = false;
            return;
        }

        $request = LeaveRequest::create([
            'employee_id' => $employee->id,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'reason' => $this->reason,
            'status' => 'pending',
        ]);

        ActivityLog::log('created', $request);

        session()->flash('success', 'Leave request submitted successfully.');
        $this->reset(['showModal', 'type', 'start_date', 'end_date', 'reason']);
    }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $request = LeaveRequest::find($this->deleteId);

        if ($request && $request->isPending() && $request->employee_id === auth()->user()->employee->id) {
            ActivityLog::log('deleted', $request, $request->toArray());
            $request->delete();
            session()->flash('success', 'Leave request deleted.');
        } else {
            session()->flash('error', 'Cannot delete this request.');
        }

        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function render(): View
    {
        $employee = auth()->user()->employee;

        $requests = LeaveRequest::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.employee.leave.leave-request-panel', [
            'requests' => $requests,
            'types' => LeaveRequest::TYPES,
            'sidebar' => view('components.employee-sidebar')->render(),
            'header' => 'Leave Requests',
        ]);
    }
}
