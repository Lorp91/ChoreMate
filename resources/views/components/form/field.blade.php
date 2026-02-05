@props(['name', 'label', 'type' => 'text', 'value' => null])

<fieldset class="fieldset">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        class="input w-full @error($name) input-error @enderror"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        {{ $attributes }}
    />

    @error($name)
    <p class="text-error">{{ $message }}</p>
    @enderror
</fieldset>
