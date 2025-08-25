{{-- resources/views/components/card.blade.php --}}
@props(['class' => '', 'title' => null])

<div {{ $attributes->merge(['class' => "overflow-hidden bg-white shadow-sm sm:rounded-lg $class"]) }}>
    @if ($title)
        <div class="border-b px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>
</div>
