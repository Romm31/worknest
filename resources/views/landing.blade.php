<x-layouts.landing>
    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-16 pb-32 flex content-center items-center justify-center min-h-[75vh]">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style="background-image: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span id="blackOverlay"
                class="w-full h-full absolute opacity-70 bg-slate-900 dark:bg-black dark:opacity-80"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 mx-auto text-center">
                    <div class="text-white">
                        <div
                            class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm border border-white/10 text-xs font-semibold tracking-wide uppercase mb-6">
                            Internal System v1.0
                        </div>
                        <h1 class="text-4xl font-bold leading-tight sm:text-6xl fade-in-up">
                            Streamline Your <span class="text-primary-400">Workforce</span>
                        </h1>
                        <p class="mt-6 text-lg text-slate-300 sm:max-w-3xl sm:mx-auto fade-in-up delay-100">
                            WorkNest is the centralized platform for employee management, attendance tracking, and leave
                            requests. Designed for efficiency and clarity.
                        </p>
                        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center fade-in-up delay-200">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg shadow-primary-600/30 flex items-center justify-center gap-2">
                                    <span>Go into Dashboard</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-8 py-3 bg-white hover:bg-slate-50 text-slate-900 font-medium rounded-lg transition-colors shadow-lg flex items-center justify-center gap-2">
                                    <span>Login to System</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="py-20 bg-slate-50 dark:bg-zinc-900 -mt-20 relative z-10 rounded-t-3xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">System Modules
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-500 dark:text-zinc-400">Core functionalities
                    available in the WorkNest platform.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Card 1 -->
                <div
                    class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none p-8 hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-zinc-700">
                    <div
                        class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Attendance Tracking</h3>
                    <p class="text-slate-500 dark:text-zinc-400 leading-relaxed">
                        Real-time Check-in/Check-out system with location verification and comprehensive daily logs.
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none p-8 hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-zinc-700">
                    <div
                        class="w-12 h-12 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Leave Management</h3>
                    <p class="text-slate-500 dark:text-zinc-400 leading-relaxed">
                        Streamlined leave request workflow. Submit applications and track approval status instantly.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none p-8 hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-zinc-700">
                    <div
                        class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Admin Dashboard</h3>
                    <p class="text-slate-500 dark:text-zinc-400 leading-relaxed">
                        Powerful insights for administrators. Manage employees, view reports, and oversee operations.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.landing>