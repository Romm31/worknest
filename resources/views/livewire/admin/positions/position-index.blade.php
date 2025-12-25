<div>
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-6">
            <x-ui.alert type="success" dismissible>{{ session('success') }}</x-ui.alert>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6">
            <x-ui.alert type="danger" dismissible>{{ session('error') }}</x-ui.alert>
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search positions..."
                class="form-input pl-10">
        </div>
        <x-ui.button wire:click="openModal" variant="primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Position
        </x-ui.button>
    </div>

    <!-- Table -->
    <x-ui.card :padding="false">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Employees</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($positions as $position)
                        <tr>
                            <td><span
                                    class="font-mono text-xs bg-slate-100 dark:bg-zinc-700 px-2 py-1 rounded">{{ $position->code }}</span>
                            </td>
                            <td class="font-medium">{{ $position->name }}</td>
                            <td class="text-slate-500 dark:text-zinc-400 max-w-xs truncate">
                                {{ $position->description ?? '-' }}</td>
                            <td>{{ $position->employees_count }}</td>
                            <td>
                                @if($position->is_active)
                                    <x-ui.badge type="success">Active</x-ui.badge>
                                @else
                                    <x-ui.badge type="danger">Inactive</x-ui.badge>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $position->id }})"
                                        class="p-2 text-slate-500 hover:text-primary-600 dark:text-zinc-400 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $position->id }})"
                                        class="p-2 text-slate-500 hover:text-red-600 dark:text-zinc-400 dark:hover:text-red-400 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <x-ui.empty-state title="No positions found"
                                    description="Get started by creating a new position.">
                                    <x-slot:action>
                                        <x-ui.button wire:click="openModal" variant="primary">Add Position</x-ui.button>
                                    </x-slot:action>
                                </x-ui.empty-state>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($positions->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700">{{ $positions->links() }}</div>
        @endif
    </x-ui.card>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70"
                    wire:click="$set('showModal', false)"></div>
                <div class="relative w-full max-w-md bg-white dark:bg-zinc-800 rounded-xl shadow-2xl">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">
                            {{ $editMode ? 'Edit Position' : 'Add Position' }}</h3>
                    </div>
                    <form wire:submit="save">
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="form-label">Position Name <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="name"
                                    class="form-input @error('name') form-input-error @enderror"
                                    placeholder="e.g., Software Engineer">
                                @error('name') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Code <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="code"
                                    class="form-input font-mono @error('code') form-input-error @enderror"
                                    placeholder="e.g., SWE" maxlength="10">
                                @error('code') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Description</label>
                                <textarea wire:model="description" class="form-input resize-none" rows="3"
                                    placeholder="Brief description..."></textarea>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" wire:model="is_active" id="is_active"
                                    class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500 dark:border-zinc-600 dark:bg-zinc-700">
                                <label for="is_active" class="text-sm text-slate-700 dark:text-zinc-300">Active</label>
                            </div>
                        </div>
                        <div
                            class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800/50 rounded-b-xl flex justify-end gap-3">
                            <x-ui.button type="button" wire:click="$set('showModal', false)"
                                variant="secondary">Cancel</x-ui.button>
                            <x-ui.button type="submit" variant="primary">{{ $editMode ? 'Update' : 'Create' }}</x-ui.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70"
                    wire:click="$set('showDeleteModal', false)"></div>
                <div class="relative w-full max-w-sm bg-white dark:bg-zinc-800 rounded-xl shadow-2xl p-6 text-center">
                    <div
                        class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100 mb-2">Delete Position</h3>
                    <p class="text-sm text-slate-500 dark:text-zinc-400 mb-6">Are you sure? This action cannot be undone.
                    </p>
                    <div class="flex justify-center gap-3">
                        <x-ui.button type="button" wire:click="$set('showDeleteModal', false)"
                            variant="secondary">Cancel</x-ui.button>
                        <x-ui.button type="button" wire:click="delete" variant="danger">Delete</x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>