<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }"
    x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark');"
    :class="{ 'dark': darkMode }">

<head>
    @include('partials.head')
</head>

<body
    class="min-h-screen bg-slate-50 dark:bg-zinc-900 transition-colors duration-300 antialiased flex flex-col items-center justify-center py-12 sm:px-6 lg:px-8">

    <!-- Theme Toggle -->
    <div class="absolute top-4 right-4">
        <button @click="toggleTheme()"
            class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:text-zinc-400 dark:hover:bg-zinc-800 transition-colors">
            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </button>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
            <div
                class="w-12 h-12 rounded-xl bg-primary-600 flex items-center justify-center text-white mb-2 shadow-lg shadow-primary-500/30">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <span class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">WorkNest</span>
            <span class="sr-only">{{ config('app.name', 'WorkNest') }}</span>
        </a>
        <h2 class="mt-2 text-center text-sm text-slate-600 dark:text-zinc-400">
            @if (isset($title))
                {{ $title }}
            @else
                Employee Management System
            @endif
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div
            class="bg-white dark:bg-zinc-800 py-8 px-4 shadow-xl shadow-slate-200/50 dark:shadow-none sm:rounded-xl sm:px-10 border border-slate-100 dark:border-zinc-700">
            {{ $slot }}
        </div>
    </div>

    @fluxScripts
</body>

</html>