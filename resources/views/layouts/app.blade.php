<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'WorkNest' }} - Employee Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-50 dark:bg-zinc-900 theme-transition">
    <div class="flex min-h-screen" x-data="{ sidebarOpen: true, mobileSidebarOpen: false }">
        <!-- Mobile sidebar backdrop -->
        <div x-show="mobileSidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
            @click="mobileSidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="{ '-translate-x-full': !mobileSidebarOpen, 'translate-x-0': mobileSidebarOpen }"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-zinc-800 border-r border-slate-200 dark:border-zinc-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-200 dark:border-zinc-700">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 dark:from-indigo-500 dark:to-indigo-700 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-slate-900 dark:text-zinc-100">WorkNest</h1>
                    <p class="text-xs text-slate-500 dark:text-zinc-400">Employee Management</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="px-4 py-6 space-y-1 overflow-y-auto h-[calc(100vh-180px)]">
                @if(request()->is('admin/*') || request()->routeIs('admin.*'))
                    @include('components.admin-sidebar')
                @else
                    @include('components.employee-sidebar')
                @endif
            </nav>

            <!-- User info (bottom) -->
            <div
                class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                        <span class="text-sm font-semibold text-primary-700 dark:text-indigo-300">
                            {{ auth()->user()->initials() }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 dark:text-zinc-100 truncate">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-zinc-400 truncate capitalize">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top navbar -->
            <header
                class="sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 py-4 bg-white dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                <!-- Left side -->
                <div class="flex items-center gap-4">
                    <!-- Mobile menu button -->
                    <button @click="mobileSidebarOpen = !mobileSidebarOpen"
                        class="lg:hidden p-2 text-slate-500 hover:text-slate-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page title -->
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-zinc-100">
                        {{ $header ?? $title ?? 'Dashboard' }}
                    </h2>
                </div>

                <!-- Right side -->
                <div class="flex items-center gap-3">
                    <!-- Theme toggle -->
                    <button @click="darkMode = !darkMode"
                        class="p-2 text-slate-500 hover:text-slate-700 dark:text-zinc-400 dark:hover:text-zinc-200 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors"
                        title="Toggle theme">
                        <!-- Sun icon (shown in dark mode) -->
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Moon icon (shown in light mode) -->
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- User dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-2 p-2 text-slate-500 hover:text-slate-700 dark:text-zinc-400 dark:hover:text-zinc-200 hover:bg-slate-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                <span class="text-xs font-semibold text-primary-700 dark:text-indigo-300">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-slate-200 dark:border-zinc-700 py-1 z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 dark:text-zinc-300 hover:bg-slate-100 dark:hover:bg-zinc-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile Settings
                            </a>
                            <div class="border-t border-slate-200 dark:border-zinc-700 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-slate-100 dark:hover:bg-zinc-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-x-hidden">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>