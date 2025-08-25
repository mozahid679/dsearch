<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section>
        <div class="mx-auto mt-2 max-w-7xl">
            <x-card class="mx-auto max-w-5xl bg-white bg-opacity-90 text-center shadow-lg">
                <x-slot name="title">
                    <h1 class="mb-4 text-4xl font-bold text-blue-800">
                        {{ __('Welcome to the Anti-Corruption Commission Search Portal') }}
                    </h1>
                </x-slot>

                <p class="mb-6 text-lg text-gray-700">
                    {{ __('Providing transparent access to public data and resources.') }}
                </p>
                <p class="mb-6 text-lg text-gray-700">
                    {{ __('Search by National ID, Name...') }}
                </p>

            </x-card>
        </div>
    </section>
</x-app-layout>
