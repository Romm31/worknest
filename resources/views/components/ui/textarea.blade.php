@props([
    'name' => null,
    'label' => null,
    'placeholder' => '',
    'rows' => 4,
    'required' => false,
    'disabled' => false,
    'error' => null,
])

<div>
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-input resize-none' . ($error ? ' form-input-error' : '')]) }}
    >{{ $slot }}</textarea>

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @endif
</div>
