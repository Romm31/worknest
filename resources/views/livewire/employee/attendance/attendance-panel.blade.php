<div>
    @if(session('success'))
        <div class="mb-6"><x-ui.alert type="success" dismissible>{{ session('success') }}</x-ui.alert></div>
    @endif
    @if(session('error'))
        <div class="mb-6"><x-ui.alert type="danger" dismissible>{{ session('error') }}</x-ui.alert></div>
    @endif

    <div class="max-w-2xl mx-auto">
        <!-- Clock Display -->
        <x-ui.card class="text-center mb-6">
            <div x-data="{ time: '{{ $currentTime->format('H:i:s') }}' }"
                x-init="setInterval(() => { time = new Date().toLocaleTimeString('en-GB') }, 1000)">
                <p class="text-6xl font-bold text-slate-900 dark:text-zinc-100 font-mono" x-text="time"></p>
                <p class="text-lg text-slate-500 dark:text-zinc-400 mt-2">{{ $currentTime->format('l, F d, Y') }}</p>
            </div>
        </x-ui.card>

        <!-- Today's Status -->
        <x-ui.card class="mb-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100 mb-4">Today's Attendance</h3>

            @if($todayAttendance)
                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-700 dark:text-green-300">Check In</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400 font-mono">
                            {{ $todayAttendance->checkInTime }}
                        </p>
                        @if($todayAttendance->isLate())
                            <p class="text-xs text-red-500 mt-1">Late arrival</p>
                        @endif
                    </div>
                    <div
                        class="p-4 rounded-lg {{ $todayAttendance->check_out ? 'bg-blue-50 dark:bg-blue-900/30 border-blue-200 dark:border-blue-800' : 'bg-slate-50 dark:bg-zinc-700/50 border-slate-200 dark:border-zinc-600' }} border">
                        <p
                            class="text-sm {{ $todayAttendance->check_out ? 'text-blue-700 dark:text-blue-300' : 'text-slate-500 dark:text-zinc-400' }}">
                            Check Out</p>
                        <p
                            class="text-2xl font-bold {{ $todayAttendance->check_out ? 'text-blue-600 dark:text-blue-400' : 'text-slate-400' }} font-mono">
                            {{ $todayAttendance->checkOutTime ?? '--:--' }}
                        </p>
                    </div>
                </div>
                @if($todayAttendance->workingHours)
                    <div class="mt-4 p-4 rounded-lg bg-slate-50 dark:bg-zinc-700/50 text-center">
                        <p class="text-sm text-slate-500 dark:text-zinc-400">Total Working Hours</p>
                        <p class="text-xl font-bold text-slate-900 dark:text-zinc-100">{{ $todayAttendance->workingHours }}
                            hours</p>
                    </div>
                @endif
            @else
                <div class="p-8 text-center">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-slate-100 dark:bg-zinc-700 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-slate-500 dark:text-zinc-400">You haven't checked in yet today</p>
                </div>
            @endif
        </x-ui.card>

        <!-- Action Buttons -->
        <div class="grid grid-cols-2 gap-4">
            <button wire:click="checkIn" wire:loading.attr="disabled" {{ !$canCheckIn ? 'disabled' : '' }} class="p-6 rounded-xl text-center transition-all duration-200 
                    {{ $canCheckIn
    ? 'bg-green-600 hover:bg-green-700 text-white cursor-pointer shadow-lg hover:shadow-xl'
    : 'bg-slate-100 dark:bg-zinc-700 text-slate-400 cursor-not-allowed' }}">
                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                <span class="text-lg font-semibold" wire:loading.remove wire:target="checkIn">Check In</span>
                <span class="text-lg font-semibold" wire:loading wire:target="checkIn">Processing...</span>
            </button>

            <button wire:click="checkOut" wire:loading.attr="disabled" {{ !$canCheckOut ? 'disabled' : '' }} class="p-6 rounded-xl text-center transition-all duration-200 
                    {{ $canCheckOut
    ? 'bg-blue-600 hover:bg-blue-700 text-white cursor-pointer shadow-lg hover:shadow-xl'
    : 'bg-slate-100 dark:bg-zinc-700 text-slate-400 cursor-not-allowed' }}">
                <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-lg font-semibold" wire:loading.remove wire:target="checkOut">Check Out</span>
                <span class="text-lg font-semibold" wire:loading wire:target="checkOut">Processing...</span>
            </button>
        </div>

        <!-- Info -->
        <div class="mt-6">
            <x-ui.alert type="info">
                <p><strong>Note:</strong> Standard work hours are 09:00 - 18:00. Check-in after 09:00 will be marked as
                    late.</p>
            </x-ui.alert>
        </div>
    </div>
</div>