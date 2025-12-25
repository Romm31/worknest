@props([
    'icon' => null,
    'title' => 'No data found',
    'description' => 'There are no records to display at this time.',
    'action' => null,
    'actionText' => 'Create New',
    'actionRoute' => null,
])

<div class="empty-state">
    @if($icon)
        <div class="empty-state-icon">
            {{ $icon }}
        </div>
    @else
        <svg class="w-16 h-16 text-slate-300 dark:text-zinc-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
    @endif
    
    <h3 class="empty-state-title">{{ $title }}</h3>
    <p class="empty-state-description max-w-sm">{{ $description }}</p>
    
    @if($action || $actionRoute)
        <div class="mt-6">
            @if($actionRoute)
                <a href="{{ $actionRoute }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ $actionText }}
                </a>
            @else
                {{ $action }}
            @endif
        </div>
    @endif
</div>
