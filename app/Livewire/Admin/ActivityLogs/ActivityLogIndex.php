<?php

namespace App\Livewire\Admin\ActivityLogs;

use App\Models\ActivityLog;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterAction = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
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
        ])->layout('layouts.app', [
                    'sidebar' => view('components.admin-sidebar'),
                    'header' => 'Activity Logs',
                ]);
    }
}
