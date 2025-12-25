<?php

namespace App\Livewire\Admin\LeaveRequests;

use App\Models\ActivityLog;
use App\Models\LeaveRequest;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class LeaveRequestIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterStatus = 'pending';
    public string $filterType = '';

    public bool $showModal = false;
    public ?LeaveRequest $selectedRequest = null;
    public string $rejectionReason = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function viewRequest(int $id): void
    {
        $this->selectedRequest = LeaveRequest::with(['employee.user', 'employee.department', 'approver'])->find($id);
        $this->rejectionReason = '';
        $this->showModal = true;
    }

    public function approve(): void
    {
        if (!$this->selectedRequest)
            return;

        $this->selectedRequest->approve(auth()->user());

        ActivityLog::log('approved', $this->selectedRequest);

        session()->flash('success', 'Leave request approved successfully.');
        $this->showModal = false;
        $this->selectedRequest = null;
    }

    public function reject(): void
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10|max:500',
        ]);

        if (!$this->selectedRequest)
            return;

        $this->selectedRequest->reject(auth()->user(), $this->rejectionReason);

        ActivityLog::log('rejected', $this->selectedRequest);

        session()->flash('success', 'Leave request rejected.');
        $this->showModal = false;
        $this->selectedRequest = null;
        $this->rejectionReason = '';
    }

    public function render(): View
    {
        $requests = LeaveRequest::with(['employee.user', 'employee.department'])
            ->when($this->search, function ($query) {
                $query->whereHas('employee.user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterType, function ($query) {
                $query->where('type', $this->filterType);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.leave-requests.leave-request-index', [
            'requests' => $requests,
            'sidebar' => view('components.admin-sidebar')->render(),
            'header' => 'Leave Requests',
        ]);
    }
}
