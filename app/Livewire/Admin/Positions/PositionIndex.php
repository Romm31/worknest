<?php

namespace App\Livewire\Admin\Positions;

use App\Models\ActivityLog;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class PositionIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public bool $editMode = false;

    public ?int $positionId = null;
    public string $name = '';
    public string $code = '';
    public ?string $description = null;
    public bool $is_active = true;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:positions,code',
        'description' => 'nullable|string|max:1000',
        'is_active' => 'boolean',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openModal(): void
    {
        $this->reset(['positionId', 'name', 'code', 'description', 'is_active', 'editMode']);
        $this->is_active = true;
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $position = Position::findOrFail($id);
        $this->positionId = $position->id;
        $this->name = $position->name;
        $this->code = $position->code;
        $this->description = $position->description;
        $this->is_active = $position->is_active;
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save(): void
    {
        $rules = $this->rules;

        if ($this->editMode) {
            $rules['code'] = 'required|string|max:10|unique:positions,code,' . $this->positionId;
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'code' => strtoupper($this->code),
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        if ($this->editMode) {
            $position = Position::findOrFail($this->positionId);
            $oldValues = $position->toArray();
            $position->update($data);

            ActivityLog::log('updated', $position, $oldValues, $position->fresh()->toArray());

            session()->flash('success', 'Position updated successfully.');
        } else {
            $position = Position::create($data);

            ActivityLog::log('created', $position);

            session()->flash('success', 'Position created successfully.');
        }

        $this->reset(['showModal', 'positionId', 'name', 'code', 'description', 'is_active', 'editMode']);
    }

    public function confirmDelete(int $id): void
    {
        $this->positionId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $position = Position::findOrFail($this->positionId);

        if ($position->employees()->count() > 0) {
            session()->flash('error', 'Cannot delete position with existing employees.');
            $this->showDeleteModal = false;
            return;
        }

        ActivityLog::log('deleted', $position, $position->toArray());

        $position->delete();

        session()->flash('success', 'Position deleted successfully.');
        $this->showDeleteModal = false;
        $this->positionId = null;
    }

    public function render(): View
    {
        $positions = Position::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->withCount('employees')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.positions.position-index', [
            'positions' => $positions,
            'sidebar' => view('components.admin-sidebar')->render(),
            'header' => 'Positions',
        ]);
    }
}
