@props(['disabled' => false, 'label', 'name', 'options' => [], 'value' => ''])

<div class="mb-4">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'form-input']) !!}
    >
        <option value="">Seleccionar</option>
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
