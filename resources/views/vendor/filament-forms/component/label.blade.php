<!-- resources/views/vendor/filament-forms/components/label.blade.php -->
@props([
    'for',
    'value',
    'required' => false
])

<label
    for="{{ $for }}"
    {{ $attributes->class([
        'block text-sm font-medium text-gray-700',
        'after:content-[\'*\'] after:ml-0.5 after:text-danger-500' => $required
    ]) }}
>
    {{ $value ?? $slot }}
</label>
