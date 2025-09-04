@extends('layouts.app')

@section('content')
    <div class="mt-12 grid grid-cols-1 gap-6 text-center sm:grid-cols-3">
        <!-- Total Searches -->
        <div class="rounded-xl bg-white bg-opacity-80 p-6 shadow transition hover:shadow-lg">
            <h2 class="stat-number text-3xl font-bold text-blue-700" data-target="{{ $totalSearches }}">
                0
            </h2>
            <p class="mt-2 text-gray-600">Total Searches</p>
        </div>

        <!-- Searches Today -->
        <div class="rounded-xl bg-white bg-opacity-80 p-6 shadow transition hover:shadow-lg">
            <h2 class="stat-number text-3xl font-bold text-emerald-700" data-target="{{ $todaySearches }}">
                0
            </h2>
            <p class="mt-2 text-gray-600">Searches Today</p>
        </div>

        <!-- System Uptime -->
        <div class="rounded-xl bg-white bg-opacity-80 p-6 shadow transition hover:shadow-lg">
            <h2 class="stat-number text-3xl font-bold text-indigo-700" data-target="{{ $uptimePercentage }}">
                0
            </h2>
            <p class="mt-2 text-gray-600">System Uptime (%)</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                let current = 0;
                const increment = target / 100; // adjust speed here
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };
                updateCounter();
            });
        });
    </script>
@endpush
