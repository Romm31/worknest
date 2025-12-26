<x-layouts.auth.simple>
    <div class="flex flex-col gap-6">
        <div class="text-center mb-4">
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Sign in to WorkNest</h1>
            <p class="text-sm text-slate-500 dark:text-zinc-400 mt-2">Enter your credentials to access the system</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input name="email" :label="__('Email address')" :value="old('email')" type="email" required autofocus
                autocomplete="email" placeholder="Required for system access" class="w-full" />

            <!-- Password -->
            <div class="relative">
                <flux:input name="password" :label="__('Password')" type="password" required
                    autocomplete="current-password" :placeholder="__('Enter your password')" viewable class="w-full" />

                @if (Route::has('password.request'))
                    <div class="absolute top-0 right-0">
                        <flux:link class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-500"
                            :href="route('password.request')" wire:navigate>
                            {{ __('Forgot password?') }}
                        </flux:link>
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Remember me for 30 days')" :checked="old('remember')" />

            <div class="pt-2">
                <flux:button variant="primary" type="submit" class="w-full justify-center py-2"
                    data-test="login-button">
                    {{ __('Sign In') }}
                </flux:button>
            </div>

            <p class="text-xs text-center text-slate-400 dark:text-zinc-500 mt-4">
                Restricted Access. Authorized Personnel Only.
            </p>
        </form>
    </div>
</x-layouts.auth.simple>