<?php

namespace App\Livewire\Admin\Positions;

use App\Models\ActivityLog;
use App\Models\Position;
use Livewire\Component;
use Livewire\WithPagination;

class PositionIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;

    public $positionId;
    public $name;
    public $code;
    public $description;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:positions,code',
        'description' => 'nullable|string|max:1000',
        'is_active' => 'boolean',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['positionId', 'name', 'code', 'description', 'is_active', 'editMode']);
        $this->is_active = true;
        $this->showModal = true;
    }

    public function edit($id)
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

    public function save()
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

    public function confirmDelete($id)
    {
        $this->positionId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
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

    /**
     * @return \Illuminate\Contracts\View\View|\Livewire\Component
     */
    public function render(): mixed
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
        ])->layout('layouts.app', [
                    'sidebar' => view('components.admin-sidebar'),
                    'header' => 'Positions',
                ]);
    }
}
