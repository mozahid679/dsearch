{{-- resources/views/components/button.blade.php --}}
@props([
    'type' => 'button',
    'variant' => 'primary', // e.g. primary, secondary, danger
    'class' => '',
])

@php
    $base =
        'inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium focus:outline-none transition';
    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-gray-100 text-blue-600 hover:bg-gray-200',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
    ];
@endphp

{{-- <button type="{{ $type }}" {{ $attributes->merge(['class' => "$base {$variants[$variant]} $class"]) }}>
    {{ $slot }}
</button> --}}
<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'self-end btn bg-blue-400 mx-auto px-4 mt-2 hover:bg-blue-500 rounded py-2']) }}>
    {{ $slot }}
</button>
