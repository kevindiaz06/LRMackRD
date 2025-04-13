@props(['disabled' => false, 'label', 'name', 'value' => '', 'type' => 'text'])

<div class="mb-4">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'form-input']) !!}
    >
    @error($name)
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
