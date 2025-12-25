<div class="max-w-xl mx-auto text-center py-12">
    <div
        class="w-16 h-16 mx-auto rounded-full bg-yellow-100 dark:bg-yellow-900/50 flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
    </div>
    <h2 class="text-xl font-bold text-slate-900 dark:text-zinc-100 mb-2">Profile Not Set Up</h2>
    <p class="text-slate-500 dark:text-zinc-400 mb-6">Your employee profile has not been configured yet. Please contact
        your administrator to set up your employee account.</p>
    <a href="{{ route('profile.edit') }}" class="btn-primary">
        Go to Account Settings
    </a>
</div>