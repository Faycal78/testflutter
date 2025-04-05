<!-- resources/views/vendor/filament-forms/components/input.blade.php -->
@props([
    'id',
    'name',
    'type' => 'text',
    'value' => '',
    'disabled' => false,
    'required' => false
])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ $value }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm']) }}
>
