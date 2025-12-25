<div class="max-w-3xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="md:col-span-1">
            <x-ui.card>
                <div class="text-center">
                    <div
                        class="w-24 h-24 rounded-full bg-primary-100 dark:bg-indigo-900/50 flex items-center justify-center mx-auto mb-4">
                        <span
                            class="text-3xl font-bold text-primary-700 dark:text-indigo-300">{{ auth()->user()->initials() }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-zinc-100">{{ auth()->user()->name }}</h2>
                    @if($employee)
                        <p class="text-sm text-slate-500 dark:text-zinc-400">{{ $employee->position->name }}</p>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">{{ $employee->department->name }}</p>
                    @endif
                </div>
            </x-ui.card>
        </div>

        <!-- Details -->
        <div class="md:col-span-2">
            <x-ui.card title="Personal Information">
                @if($employee)
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">Employee Code</p>
                                <p class="font-mono text-slate-900 dark:text-zinc-100">{{ $employee->employee_code }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">Email</p>
                                <p class="text-slate-900 dark:text-zinc-100">{{ auth()->user()->email }}</p>
                            </div>
                            @if($employee->phone)
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Phone</p>
                                    <p class="text-slate-900 dark:text-zinc-100">{{ $employee->phone }}</p>
                                </div>
                            @endif
                            @if($employee->date_of_birth)
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Date of Birth</p>
                                    <p class="text-slate-900 dark:text-zinc-100">
                                        {{ $employee->date_of_birth->format('M d, Y') }}</p>
                                </div>
                            @endif
                            @if($employee->gender)
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">Gender</p>
                                    <p class="text-slate-900 dark:text-zinc-100 capitalize">{{ $employee->gender }}</p>
                                </div>
                            @endif
                            <div>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">Hire Date</p>
                                <p class="text-slate-900 dark:text-zinc-100">{{ $employee->hire_date->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        @if($employee->address)
                            <div class="pt-4 border-t border-slate-200 dark:border-zinc-700">
                                <p class="text-xs text-slate-500 dark:text-zinc-400 mb-1">Address</p>
                                <p class="text-slate-900 dark:text-zinc-100">{{ $employee->address }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <x-ui.empty-state title="Profile not found"
                        description="Your employee profile has not been set up yet." />
                @endif
            </x-ui.card>

            <!-- Quick Links -->
            <div class="mt-6">
                <x-ui.card title="Quick Links">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('profile.edit') }}"
                            class="p-4 rounded-lg bg-slate-50 dark:bg-zinc-700/50 hover:bg-slate-100 dark:hover:bg-zinc-600/50 transition-colors">
                            <svg class="w-6 h-6 text-primary-600 dark:text-indigo-400 mb-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="font-medium text-slate-900 dark:text-zinc-100">Account Settings</p>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Update name, email & password</p>
                        </a>
                        <a href="{{ route('employee.attendance.history') }}"
                            class="p-4 rounded-lg bg-slate-50 dark:bg-zinc-700/50 hover:bg-slate-100 dark:hover:bg-zinc-600/50 transition-colors">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400 mb-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="font-medium text-slate-900 dark:text-zinc-100">Attendance History</p>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">View your attendance records</p>
                        </a>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>
</div>