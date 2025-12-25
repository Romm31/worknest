<div>
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-6"><x-ui.alert type="success" dismissible>{{ session('success') }}</x-ui.alert></div>
    @endif
    @if(session('error'))
        <div class="mb-6"><x-ui.alert type="danger" dismissible>{{ session('error') }}</x-ui.alert></div>
    @endif

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 flex-1">
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search employees..." class="form-input pl-10">
            </div>
            <select wire:model.live="filterDepartment" class="form-select">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterStatus" class="form-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="terminated">Terminated</option>
            </select>
        </div>
        <x-ui.button wire:click="openModal" variant="primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Employee
        </x-ui.button>
    </div>

    <!-- Table -->
    <x-ui.card :padding="false">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Code</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                        <span class="text-sm font-semibold text-primary-700 dark:text-indigo-300">{{ $employee->user->initials() }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $employee->user->name }}</p>
                                        <p class="text-sm text-slate-500 dark:text-zinc-400">{{ $employee->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="font-mono text-xs bg-slate-100 dark:bg-zinc-700 px-2 py-1 rounded">{{ $employee->employee_code }}</span></td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->position->name }}</td>
                            <td>
                                @switch($employee->status)
                                    @case('active')
                                        <x-ui.badge type="success">Active</x-ui.badge>
                                        @break
                                    @case('inactive')
                                        <x-ui.badge type="warning">Inactive</x-ui.badge>
                                        @break
                                    @case('terminated')
                                        <x-ui.badge type="danger">Terminated</x-ui.badge>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.employees.show', $employee) }}" class="p-2 text-slate-500 hover:text-primary-600 dark:text-zinc-400 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <button wire:click="edit({{ $employee->id }})" class="p-2 text-slate-500 hover:text-primary-600 dark:text-zinc-400 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $employee->id }})" class="p-2 text-slate-500 hover:text-red-600 dark:text-zinc-400 dark:hover:text-red-400 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <x-ui.empty-state title="No employees found" description="Get started by adding a new employee.">
                                    <x-slot:action>
                                        <x-ui.button wire:click="openModal" variant="primary">Add Employee</x-ui.button>
                                    </x-slot:action>
                                </x-ui.empty-state>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($employees->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700">{{ $employees->links() }}</div>
        @endif
    </x-ui.card>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70" wire:click="$set('showModal', false)"></div>
                <div class="relative w-full max-w-2xl bg-white dark:bg-zinc-800 rounded-xl shadow-2xl">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">{{ $editMode ? 'Edit Employee' : 'Add Employee' }}</h3>
                    </div>
                    <form wire:submit="save">
                        <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="name" class="form-input @error('name') form-input-error @enderror">
                                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">Email <span class="text-red-500">*</span></label>
                                    <input type="email" wire:model="email" class="form-input @error('email') form-input-error @enderror">
                                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">Password {{ $editMode ? '(leave blank to keep)' : '*' }}</label>
                                    <input type="password" wire:model="password" class="form-input @error('password') form-input-error @enderror">
                                    @error('password') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">Hire Date <span class="text-red-500">*</span></label>
                                    <input type="date" wire:model="hire_date" class="form-input @error('hire_date') form-input-error @enderror">
                                    @error('hire_date') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">Department <span class="text-red-500">*</span></label>
                                    <select wire:model="department_id" class="form-select @error('department_id') form-input-error @enderror">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">Position <span class="text-red-500">*</span></label>
                                    <select wire:model="position_id" class="form-select @error('position_id') form-input-error @enderror">
                                        <option value="">Select Position</option>
                                        @foreach($positions as $pos)
                                            <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('position_id') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">Phone</label>
                                    <input type="text" wire:model="phone" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" wire:model="date_of_birth" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Gender</label>
                                    <select wire:model="gender" class="form-select">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Status <span class="text-red-500">*</span></label>
                                    <select wire:model="status" class="form-select @error('status') form-input-error @enderror">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="terminated">Terminated</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Address</label>
                                <textarea wire:model="address" class="form-input resize-none" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800/50 rounded-b-xl flex justify-end gap-3">
                            <x-ui.button type="button" wire:click="$set('showModal', false)" variant="secondary">Cancel</x-ui.button>
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
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70" wire:click="$set('showDeleteModal', false)"></div>
                <div class="relative w-full max-w-sm bg-white dark:bg-zinc-800 rounded-xl shadow-2xl p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100 mb-2">Delete Employee</h3>
                    <p class="text-sm text-slate-500 dark:text-zinc-400 mb-6">This will also delete the user account. This action cannot be undone.</p>
                    <div class="flex justify-center gap-3">
                        <x-ui.button type="button" wire:click="$set('showDeleteModal', false)" variant="secondary">Cancel</x-ui.button>
                        <x-ui.button type="button" wire:click="delete" variant="danger">Delete</x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
