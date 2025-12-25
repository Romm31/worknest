<?php

namespace App\Livewire\Admin\ActivityLogs;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ActivityLogIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterAction = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $logs = ActivityLog::with('user')
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterAction, function ($query) {
                $query->where('action', $this->filterAction);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.admin.activity-logs.activity-log-index', [
            'logs' => $logs,
            'actions' => ActivityLog::ACTIONS,
            'sidebar' => view('components.admin-sidebar')->render(),
            'header' => 'Activity Logs',
        ]);
    }
}
