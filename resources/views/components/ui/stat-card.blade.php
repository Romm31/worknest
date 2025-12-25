@props([
    'title',
    'value',
    'icon' => null,
    'iconBg' => 'bg-primary-100 dark:bg-indigo-900/50',
    'iconColor' => 'text-primary-600 dark:text-indigo-400',
    'change' => null,
    'changeType' => 'neutral', // positive, negative, neutral
    'link' => null,
    'linkText' => 'View all',
])

<div class="card p-6">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-slate-500 dark:text-zinc-400">{{ $title }}</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-zinc-100">{{ $value }}</p>
            
            @if($change)
                <p class="mt-2 flex items-center text-sm">
                    @if($changeType === 'positive')
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="text-green-600 dark:text-green-400 font-medium">{{ $change }}</span>
                    @elseif($changeType === 'negative')
                        <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="text-red-600 dark:text-red-400 font-medium">{{ $change }}</span>
                    @else
                        <span class="text-slate-500 dark:text-zinc-400">{{ $change }}</span>
                    @endif
                </p>
            @endif
        </div>
        
        @if($icon)
            <div class="flex-shrink-0 {{ $iconBg }} p-3 rounded-lg">
                <div class="{{ $iconColor }}">
                    {{ $icon }}
                </div>
            </div>
        @endif
    </div>
    
    @if($link)
        <div class="mt-4 pt-4 border-t border-slate-200 dark:border-zinc-700">
            <a href="{{ $link }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center gap-1">
                {{ $linkText }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    @endif
</div>
