<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 flex-1">
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by user..." class="form-input pl-10">
            </div>
            <select wire:model.live="filterAction" class="form-select">
                <option value="">All Actions</option>
                @foreach($actions as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Logs -->
    <x-ui.card :padding="false">
        <div class="divide-y divide-slate-200 dark:divide-zinc-700">
            @forelse($logs as $log)
                <div class="p-4 hover:bg-slate-50 dark:hover:bg-zinc-700/50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                            @switch($log->action)
                                @case('created') bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 @break
                                @case('updated') bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 @break
                                @case('deleted') bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 @break
                                @case('login') bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 @break
                                @case('check_in') @case('check_out') bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 @break
                                @case('approved') bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 @break
                                @case('rejected') bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 @break
                                @default bg-slate-100 dark:bg-zinc-700 text-slate-600 dark:text-zinc-400
                            @endswitch
                        ">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @switch($log->action)
                                    @case('created')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        @break
                                    @case('updated')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        @break
                                    @case('deleted')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        @break
                                    @default
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @endswitch
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900 dark:text-zinc-100">
                                <span class="font-medium">{{ $log->user?->name ?? 'System' }}</span>
                                <span class="text-slate-500 dark:text-zinc-400">{{ $log->actionLabel }}</span>
                                @if($log->modelName)
                                    <span class="font-medium">{{ $log->modelName }}</span>
                                @endif
                                @if($log->model_id)
                                    <span class="text-slate-500 dark:text-zinc-400">#{{ $log->model_id }}</span>
                                @endif
                            </p>
                            <p class="text-xs text-slate-500 dark:text-zinc-400 mt-1">
                                {{ $log->created_at->format('M d, Y H:i:s') }}
                                @if($log->ip_address)
                                    • IP: {{ $log->ip_address }}
                                @endif
                            </p>
                        </div>
                        <x-ui.badge :type="$log->actionColor">{{ $log->actionLabel }}</x-ui.badge>
                    </div>
                </div>
            @empty
                <div class="p-12">
                    <x-ui.empty-state title="No activity logs" description="Activity logs will appear here as users interact with the system." />
                </div>
            @endforelse
        </div>
        @if($logs->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700">{{ $logs->links() }}</div>
        @endif
    </x-ui.card>
</div>
