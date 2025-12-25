@props([
    'type' => 'default',
    'size' => 'md',
])
@php
    $types = [
        'default' => 'bg-slate-100 text-slate-800 dark:bg-zinc-700 dark:text-zinc-300',
        'primary' => 'bg-primary-100 text-primary-800 dark:bg-indigo-900/50 dark:text-indigo-300',
        'success' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
        'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
        'danger' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
        'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300',
    ];

    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-0.5 text-xs',
        'lg' => 'px-3 py-1 text-sm',
    ];

    $classes = 'inline-flex items-center font-medium rounded-full ' . ($types[$type] ?? $types['default']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
