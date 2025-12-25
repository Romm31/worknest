<div>
    @if(session('success'))
        <div class="mb-6"><x-ui.alert type="success" dismissible>{{ session('success') }}</x-ui.alert></div>
    @endif

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 flex-1">
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by employee name..." class="form-input pl-10">
            </div>
            <select wire:model.live="filterStatus" class="form-select">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            <select wire:model.live="filterType" class="form-select">
                <option value="">All Types</option>
                <option value="sick">Sick Leave</option>
                <option value="vacation">Vacation</option>
                <option value="personal">Personal</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <x-ui.card :padding="false">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Days</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                        <span class="text-sm font-semibold text-primary-700 dark:text-indigo-300">{{ $request->employee->user->initials() }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $request->employee->user->name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $request->employee->department->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td><x-ui.badge type="info">{{ $request->typeLabel }}</x-ui.badge></td>
                            <td>
                                <p class="text-sm text-slate-900 dark:text-zinc-100">{{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}</p>
                            </td>
                            <td>{{ $request->daysCount }} days</td>
                            <td><x-ui.badge :type="$request->statusColor">{{ $request->statusLabel }}</x-ui.badge></td>
                            <td class="text-sm text-slate-500 dark:text-zinc-400">{{ $request->created_at->diffForHumans() }}</td>
                            <td class="text-right">
                                <button wire:click="viewRequest({{ $request->id }})" class="p-2 text-slate-500 hover:text-primary-600 dark:text-zinc-400 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <x-ui.empty-state title="No leave requests" description="No leave requests found matching your filters." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700">{{ $requests->links() }}</div>
        @endif
    </x-ui.card>

    <!-- View/Approve/Reject Modal -->
    @if($showModal && $selectedRequest)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70" wire:click="$set('showModal', false)"></div>
                <div class="relative w-full max-w-lg bg-white dark:bg-zinc-800 rounded-xl shadow-2xl">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">Leave Request Details</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                <span class="font-semibold text-primary-700 dark:text-indigo-300">{{ $selectedRequest->employee->user->initials() }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $selectedRequest->employee->user->name }}</p>
                                <p class="text-sm text-slate-500 dark:text-zinc-400">{{ $selectedRequest->employee->position->name }} • {{ $selectedRequest->employee->department->name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-200 dark:border-zinc-700">
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">Leave Type</p>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $selectedRequest->typeLabel }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">Duration</p>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $selectedRequest->daysCount }} days</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">Start Date</p>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $selectedRequest->start_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">End Date</p>
                                <p class="font-medium text-slate-900 dark:text-zinc-100">{{ $selectedRequest->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-200 dark:border-zinc-700">
                            <p class="text-xs text-slate-500 dark:text-zinc-400 mb-1">Reason</p>
                            <p class="text-slate-900 dark:text-zinc-100">{{ $selectedRequest->reason }}</p>
                        </div>

                        @if($selectedRequest->isPending())
                            <div class="pt-4 border-t border-slate-200 dark:border-zinc-700">
                                <label class="form-label">Rejection Reason (if rejecting)</label>
                                <textarea wire:model="rejectionReason" class="form-input resize-none @error('rejectionReason') form-input-error @enderror" rows="3" placeholder="Provide a reason for rejection..."></textarea>
                                @error('rejectionReason') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        @endif

                        @if($selectedRequest->approver)
                            <div class="pt-4 border-t border-slate-200 dark:border-zinc-700">
                                <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $selectedRequest->isApproved() ? 'Approved' : 'Rejected' }} by {{ $selectedRequest->approver->name }}</p>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">{{ $selectedRequest->approved_at->format('M d, Y H:i') }}</p>
                                @if($selectedRequest->rejection_reason)
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $selectedRequest->rejection_reason }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800/50 rounded-b-xl flex justify-end gap-3">
                        <x-ui.button type="button" wire:click="$set('showModal', false)" variant="secondary">Close</x-ui.button>
                        @if($selectedRequest->isPending())
                            <x-ui.button type="button" wire:click="reject" variant="danger">Reject</x-ui.button>
                            <x-ui.button type="button" wire:click="approve" variant="success">Approve</x-ui.button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
