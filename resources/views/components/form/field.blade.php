@props(['name', 'label', 'type' => 'text', 'value' => null])

<fieldset class="fieldset">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" class="textarea w-full @error($name) input-error @enderror"
            {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @else
        <input id="{{ $name }}" name="{{ $name }}" class="input w-full @error($name) input-error @enderror"
            type="{{ $type }}" value="{{ old($name, $value) }}" {{ $attributes }} />
    @endif

    @error($name)
        <p class="text-error">{{ $message }}</p>
    @enderror
</fieldset>
