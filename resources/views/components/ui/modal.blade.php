@props([
    'name',
    'show' => false,
    'maxWidth' => 'lg',
])

@php
    $maxWidthClasses = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
    ];
@endphp

<div
    x-data="{ show: @entangle($attributes->wire('model')).live }"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
>
    <!-- Backdrop -->
    <div 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-zinc-900/70"
        @click="show = false"
    ></div>

    <!-- Modal content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full {{ $maxWidthClasses[$maxWidth] ?? 'max-w-lg' }} bg-white dark:bg-zinc-800 rounded-xl shadow-2xl"
        >
            <!-- Close button -->
            <button 
                @click="show = false" 
                class="absolute top-4 right-4 p-1 text-slate-400 hover:text-slate-600 dark:text-zinc-500 dark:hover:text-zinc-300 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal header -->
            @if(isset($header))
                <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-700">
                    {{ $header }}
                </div>
            @endif

            <!-- Modal body -->
            <div class="p-6">
                {{ $slot }}
            </div>

            <!-- Modal footer -->
            @if(isset($footer))
                <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800/50 rounded-b-xl">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
