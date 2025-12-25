@props([
    'title' => null,
    'description' => null,
    'padding' => true,
])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @if($title || isset($header))
        <div class="card-header">
            @if(isset($header))
                {{ $header }}
            @else
                <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">{{ $title }}</h3>
                @if($description)
                    <p class="text-sm text-slate-500 dark:text-zinc-400 mt-1">{{ $description }}</p>
                @endif
            @endif
        </div>
    @endif

    <div class="{{ $padding ? 'card-body' : '' }}">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
