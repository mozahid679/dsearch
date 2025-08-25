{{-- resources/views/components/input.blade.php --}}
@props(['type' => 'text', 'id', 'placeholder', 'class' => ''])

<input id="{{ $id }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => "border rounded px-4 py-3 focus:outline-none $class"]) }} />
