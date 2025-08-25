<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <section class="relative isolate overflow-hidden bg-gradient-to-tr from-blue-100 via-white to-emerald-100 py-24">
        <!-- Animated SVG Background -->
        <div class="absolute inset-0 -z-10">
            <svg class="absolute left-0 top-0 h-full w-full animate-pulse opacity-20" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 800 800" fill="none">
                <circle cx="400" cy="400" r="400" fill="url(#grad)" />
                <defs>
                    <radialGradient id="grad" cx="0.5" cy="0.5" r="0.5">
                        <stop offset="0%" stop-color="#3b82f6" />
                        <stop offset="100%" stop-color="#10b981" />
                    </radialGradient>
                </defs>
            </svg>
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 text-center">
            <x-card
                class="mx-auto max-w-4xl rounded-2xl border border-gray-200 bg-white bg-opacity-90 shadow-2xl backdrop-blur-md transition duration-300 hover:scale-[1.01]">
                <x-slot name="title">
                    <h1 class="mb-6 text-5xl font-extrabold leading-tight tracking-tight text-blue-900">
                        {{ __('Anti-Corruption Commission Search Portal') }}
                    </h1>
                </x-slot>

                <p class="mb-4 text-lg text-gray-700">
                    {{ __('Access verified public records with transparency and trust.') }}
                </p>
                <p class="mb-6 text-lg text-gray-700">
                    {{ __('Search by National ID, Name, or Organization.') }}
                </p>

                <!-- Interactive CTA with hover animation -->
                <a class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 to-emerald-500 px-6 py-3 font-semibold text-white shadow-lg transition duration-200 hover:scale-105"
                    href="{{ route('person.search.form') }}">
                    <svg class="h-5 w-5 animate-bounce" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    {{ __('Start Your Search') }}
                </a>
            </x-card>

            <!-- Animated Stats Section -->
            <div class="mt-12 grid grid-cols-1 gap-6 text-center sm:grid-cols-3">
                <div class="rounded-xl bg-white bg-opacity-80 p-6 shadow transition hover:shadow-lg">
                    <h2 class="text-3xl font-bold text-blue-700" x-data="{ count: 0 }" x-init="let i = setInterval(() => { if (count < 2000000) count += 5000 }, 10)">
                        <span x-text="count.toLocaleString()"></span>+
                    </h2>
                    <p class="mt-2 text-gray-600">Records Indexed</p>
                </div>
                <div class="rounded-xl bg-white bg-opacity-80 p-6 shadow transition hover:shadow-lg">
                    <h2 class="text-3xl font-bold text-emerald-700" x-data="{ count: 0 }" x-init="let i = setInterval(() => { if (count < 100000) count += 1000 }, 20)">
                        <span x-text="count.toLocaleString()"></span>+
                    </h2>
                    <p class="mt-2 text-gray-600">Verified Entries</p>
                </div>
                <div class="rounded-xl bg-white bg-opacity-80 p-6 shadow transition hover:shadow-lg">
                    <h2 class="text-3xl font-bold text-indigo-700" x-data="{ count: 0 }" x-init="let i = setInterval(() => { if (count < 5000) count += 50 }, 30)">
                        <span x-text="count.toLocaleString()"></span>+
                    </h2>
                    <p class="mt-2 text-gray-600">Searches Today</p>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
