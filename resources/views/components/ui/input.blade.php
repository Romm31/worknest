@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
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

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-input' . ($error ? ' form-input-error' : '')]) }}
    >

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @endif
</div>
