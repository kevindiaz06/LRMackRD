@props(['disabled' => false, 'label', 'name', 'value' => ''])

<div class="mb-4">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'form-input', 'rows' => 3]) !!}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
