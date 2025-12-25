@props([
    'name' => null,
    'label' => null,
    'placeholder' => 'Select an option',
    'required' => false,
    'disabled' => false,
    'error' => null,
    'options' => [],
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

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-select' . ($error ? ' form-input-error' : '')]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $value => $optionLabel)
            <option value="{{ $value }}">{{ $optionLabel }}</option>
        @endforeach
        {{ $slot }}
    </select>

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @endif
</div>
