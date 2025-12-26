<x-layouts.landing>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pt-16">
        <!-- Background -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950">
        </div>
        <div
            class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(59,130,246,0.1),transparent_50%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(59,130,246,0.15),transparent_50%)]">
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 dark:bg-primary-900/30 border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-primary-300 text-sm font-medium mb-8">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                Internal HR Management System
            </div>

            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-slate-900 dark:text-white tracking-tight">
                WorkNest
            </h1>

            <p class="mt-6 text-xl sm:text-2xl text-slate-600 dark:text-zinc-400 max-w-3xl mx-auto leading-relaxed">
                Streamline HR operations with an all-in-one employee management platform.
                Track attendance, manage leave requests, and maintain employee records efficiently.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white text-lg font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/30 hover:-translate-y-0.5">
                        Go to Dashboard
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white text-lg font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/30 hover:-translate-y-0.5">
                        Get Started
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endauth
                <a href="#features"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-zinc-800 text-slate-700 dark:text-zinc-200 text-lg font-semibold rounded-xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 dark:hover:bg-zinc-700 transition-all duration-200">
                    View Features
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
            <div class="w-6 h-10 border-2 border-slate-300 dark:border-zinc-600 rounded-full flex justify-center">
                <div class="w-1.5 h-3 bg-slate-400 dark:bg-zinc-500 rounded-full mt-2 animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- Problem Statement Section -->
    <section class="py-20 bg-slate-50 dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                    Common HR Management Challenges
                </h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    Many organizations struggle with outdated and fragmented HR processes that reduce efficiency.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Problem 1 -->
                <div class="bg-white dark:bg-zinc-800 rounded-2xl p-8 border border-slate-200 dark:border-zinc-700">
                    <div
                        class="w-14 h-14 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Manual Attendance Tracking</h3>
                    <p class="text-slate-600 dark:text-zinc-400">
                        Paper-based or spreadsheet attendance creates errors, delays, and lack of real-time visibility
                        into workforce presence.
                    </p>
                </div>

                <!-- Problem 2 -->
                <div class="bg-white dark:bg-zinc-800 rounded-2xl p-8 border border-slate-200 dark:border-zinc-700">
                    <div
                        class="w-14 h-14 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Fragmented Leave Management</h3>
                    <p class="text-slate-600 dark:text-zinc-400">
                        Leave requests via email or forms lead to lost requests, approval bottlenecks, and inaccurate
                        balance tracking.
                    </p>
                </div>

                <!-- Problem 3 -->
                <div class="bg-white dark:bg-zinc-800 rounded-2xl p-8 border border-slate-200 dark:border-zinc-700">
                    <div
                        class="w-14 h-14 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Scattered Employee Data</h3>
                    <p class="text-slate-600 dark:text-zinc-400">
                        Employee information spread across multiple systems makes it difficult to maintain accurate and
                        up-to-date records.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Solution Overview Section -->
    <section class="py-20 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        The Solution
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-6">
                        A Unified Platform for All HR Operations
                    </h2>
                    <p class="text-lg text-slate-600 dark:text-zinc-400 mb-8">
                        WorkNest centralizes your HR workflows into a single, intuitive platform. Replace manual
                        processes with digital efficiency and gain complete visibility into your workforce operations.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">Real-time Attendance</h4>
                                <p class="text-slate-600 dark:text-zinc-400">Digital clock-in and clock-out with instant
                                    visibility for administrators.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">Streamlined Leave Requests</h4>
                                <p class="text-slate-600 dark:text-zinc-400">Submit, track, and approve leave requests
                                    through a clear workflow.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">Centralized Employee Records
                                </h4>
                                <p class="text-slate-600 dark:text-zinc-400">All employee data in one secure, accessible
                                    location.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-3xl p-8 text-white">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-white/20 backdrop-blur rounded-2xl p-6">
                                <div class="text-4xl font-bold mb-1">100%</div>
                                <div class="text-sm text-white/80">Digital Attendance</div>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-2xl p-6">
                                <div class="text-4xl font-bold mb-1">Real-time</div>
                                <div class="text-sm text-white/80">Leave Tracking</div>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-2xl p-6">
                                <div class="text-4xl font-bold mb-1">Single</div>
                                <div class="text-sm text-white/80">Source of Truth</div>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-2xl p-6">
                                <div class="text-4xl font-bold mb-1">Secure</div>
                                <div class="text-sm text-white/80">Employee Data</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section id="features" class="py-20 bg-slate-50 dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                    Platform Features
                </h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    Comprehensive tools for administrators and employees to manage HR operations efficiently.
                </p>
            </div>

            <!-- Admin Features -->
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div
                        class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Admin Features</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Employee Management</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">Add, edit, and manage employee records with
                            department and position assignments.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Attendance Monitoring</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">View real-time attendance data and generate
                            comprehensive attendance reports.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Leave Approval</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">Review and process leave requests with
                            approval or rejection workflows.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Activity Logs</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">Track system activities and maintain audit
                            trails for compliance.</p>
                    </div>
                </div>
            </div>

            <!-- Employee Features -->
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Employee Features</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Clock In / Clock Out</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">Simple one-click attendance recording for
                            daily check-in and check-out.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Leave Requests</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">Submit leave applications and track
                            approval status in real-time.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Profile Management</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">View and update personal information and
                            account settings.</p>
                    </div>

                    <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-slate-200 dark:border-zinc-700">
                        <div
                            class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Attendance History</h4>
                        <p class="text-sm text-slate-600 dark:text-zinc-400">Review personal attendance records and
                            identify patterns.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                    How It Works
                </h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    Get started with WorkNest in just a few simple steps.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div
                        class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Login to System</h3>
                    <p class="text-slate-600 dark:text-zinc-400 text-sm">
                        Access the platform using your company-provided credentials.
                    </p>
                    <!-- Arrow -->
                    <div
                        class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-slate-200 dark:bg-zinc-700 -translate-x-1/2">
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center">
                    <div
                        class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Record Attendance</h3>
                    <p class="text-slate-600 dark:text-zinc-400 text-sm">
                        Clock in when you arrive and clock out when you leave.
                    </p>
                    <div
                        class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-slate-200 dark:bg-zinc-700 -translate-x-1/2">
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div
                        class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Manage Requests</h3>
                    <p class="text-slate-600 dark:text-zinc-400 text-sm">
                        Submit leave requests and track their approval status.
                    </p>
                    <div
                        class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-slate-200 dark:bg-zinc-700 -translate-x-1/2">
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="relative text-center">
                    <div
                        class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        4
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Monitor Progress</h3>
                    <p class="text-slate-600 dark:text-zinc-400 text-sm">
                        View your attendance history and leave balances anytime.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- System Roles Section -->
    <section class="py-20 bg-slate-50 dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">
                    System Roles
                </h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    WorkNest supports two primary user roles with distinct capabilities.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Admin Role -->
                <div
                    class="bg-white dark:bg-zinc-800 rounded-2xl p-8 border border-slate-200 dark:border-zinc-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-purple-100 dark:bg-purple-900/20 rounded-full -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div class="relative">
                        <div
                            class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Administrator</h3>
                        <p class="text-slate-600 dark:text-zinc-400 mb-6">
                            Full system access for HR personnel and management.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Manage employee records
                            </li>
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Monitor attendance
                            </li>
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Approve leave requests
                            </li>
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Configure departments
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Employee Role -->
                <div
                    class="bg-white dark:bg-zinc-800 rounded-2xl p-8 border border-slate-200 dark:border-zinc-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-teal-100 dark:bg-teal-900/20 rounded-full -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div class="relative">
                        <div
                            class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Employee</h3>
                        <p class="text-slate-600 dark:text-zinc-400 mb-6">
                            Personal access for daily work activities and self-service.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Clock in and out
                            </li>
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Request leave
                            </li>
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                View attendance history
                            </li>
                            <li class="flex items-center gap-3 text-slate-700 dark:text-zinc-300">
                                <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Update profile
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section
        class="py-24 bg-gradient-to-br from-primary-600 to-primary-800 dark:from-primary-800 dark:to-primary-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.1),transparent_50%)]">
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Ready to Streamline Your HR Operations?
            </h2>
            <p class="text-xl text-primary-100 mb-10 max-w-2xl mx-auto">
                Access WorkNest now to start managing attendance, leave requests, and employee records efficiently.
            </p>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center gap-2 px-10 py-4 bg-white text-primary-700 text-lg font-semibold rounded-xl hover:bg-primary-50 transition-all duration-200 shadow-xl shadow-black/10 hover:shadow-2xl hover:-translate-y-0.5">
                    Go to Dashboard
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-2 px-10 py-4 bg-white text-primary-700 text-lg font-semibold rounded-xl hover:bg-primary-50 transition-all duration-200 shadow-xl shadow-black/10 hover:shadow-2xl hover:-translate-y-0.5">
                    Login to Get Started
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            @endauth
        </div>
    </section>
</x-layouts.landing>