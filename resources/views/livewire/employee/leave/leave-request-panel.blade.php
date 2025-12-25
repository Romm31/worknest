<div>
    @if(session('success'))
        <div class="mb-6"><x-ui.alert type="success" dismissible>{{ session('success') }}</x-ui.alert></div>
    @endif
    @if(session('error'))
        <div class="mb-6"><x-ui.alert type="danger" dismissible>{{ session('error') }}</x-ui.alert></div>
    @endif

    <!-- Header -->
    <div class="flex justify-end mb-6">
        <x-ui.button wire:click="openModal" variant="primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Request Leave
        </x-ui.button>
    </div>

    <!-- Requests -->
    <x-ui.card :padding="false">
        <div class="divide-y divide-slate-200 dark:divide-zinc-700">
            @forelse($requests as $request)
                <div class="p-4 hover:bg-slate-50 dark:hover:bg-zinc-700/50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <x-ui.badge type="info">{{ $request->typeLabel }}</x-ui.badge>
                                <x-ui.badge :type="$request->statusColor">{{ $request->statusLabel }}</x-ui.badge>
                            </div>
                            <p class="text-sm text-slate-900 dark:text-zinc-100">
                                {{ $request->start_date->format('M d, Y') }} - {{ $request->end_date->format('M d, Y') }}
                                <span class="text-slate-500 dark:text-zinc-400">({{ $request->daysCount }} days)</span>
                            </p>
                            <p class="text-sm text-slate-500 dark:text-zinc-400 mt-1 line-clamp-2">{{ $request->reason }}
                            </p>
                            @if($request->rejection_reason)
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">
                                    <strong>Rejection reason:</strong> {{ $request->rejection_reason }}
                                </p>
                            @endif
                            <p class="text-xs text-slate-400 dark:text-zinc-500 mt-2">Submitted
                                {{ $request->created_at->diffForHumans() }}</p>
                        </div>
                        @if($request->isPending())
                            <button wire:click="confirmDelete({{ $request->id }})"
                                class="p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12">
                    <x-ui.empty-state title="No leave requests" description="You haven't submitted any leave requests yet.">
                        <x-slot:action>
                            <x-ui.button wire:click="openModal" variant="primary">Request Leave</x-ui.button>
                        </x-slot:action>
                    </x-ui.empty-state>
                </div>
            @endforelse
        </div>
        @if($requests->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700">{{ $requests->links() }}</div>
        @endif
    </x-ui.card>

    <!-- Create Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70"
                    wire:click="$set('showModal', false)"></div>
                <div class="relative w-full max-w-md bg-white dark:bg-zinc-800 rounded-xl shadow-2xl">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">Request Leave</h3>
                    </div>
                    <form wire:submit="submit">
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="form-label">Leave Type <span class="text-red-500">*</span></label>
                                <select wire:model="type" class="form-select @error('type') form-input-error @enderror">
                                    <option value="">Select type</option>
                                    @foreach($types as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('type') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Start Date <span class="text-red-500">*</span></label>
                                    <input type="date" wire:model="start_date"
                                        class="form-input @error('start_date') form-input-error @enderror">
                                    @error('start_date') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="form-label">End Date <span class="text-red-500">*</span></label>
                                    <input type="date" wire:model="end_date"
                                        class="form-input @error('end_date') form-input-error @enderror">
                                    @error('end_date') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Reason <span class="text-red-500">*</span></label>
                                <textarea wire:model="reason"
                                    class="form-input resize-none @error('reason') form-input-error @enderror" rows="4"
                                    placeholder="Please provide a detailed reason..."></textarea>
                                @error('reason') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div
                            class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800/50 rounded-b-xl flex justify-end gap-3">
                            <x-ui.button type="button" wire:click="$set('showModal', false)"
                                variant="secondary">Cancel</x-ui.button>
                            <x-ui.button type="submit" variant="primary">Submit Request</x-ui.button>
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
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100 mb-2">Cancel Request</h3>
                    <p class="text-sm text-slate-500 dark:text-zinc-400 mb-6">Are you sure you want to cancel this leave
                        request?</p>
                    <div class="flex justify-center gap-3">
                        <x-ui.button type="button" wire:click="$set('showDeleteModal', false)" variant="secondary">Keep
                            It</x-ui.button>
                        <x-ui.button type="button" wire:click="delete" variant="danger">Cancel Request</x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>