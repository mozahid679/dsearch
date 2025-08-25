<x-app-layout>
    {{-- Optional Header Slot --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- Hero Section --}}
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        <div class="hero-content mx-auto max-w-lg rounded-lg bg-white bg-opacity-90 p-10 text-center shadow-lg">
            <h1 class="mb-4 text-4xl font-bold text-blue-800">
                Welcome to the Anti-Corruption Commission Search Portal
            </h1>
            <p class="mb-6 text-lg text-gray-700">
                Providing transparent access to public data and resources.
            </p>

            <div class="relative">
                <input class="w-full rounded-lg border px-4 py-3 focus:outline-none" id="search-input" type="text"
                    placeholder="Search by National ID, Name...">
                <button class="absolute right-0 top-0 rounded-r-lg bg-blue-600 px-4 py-3 text-white hover:bg-blue-700"
                    id="search-button">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>

            <p class="mt-2 text-sm text-gray-500">
                Use advanced options for a detailed search.
            </p>

            <div class="mt-6">
                <button class="rounded-md bg-gray-100 px-4 py-2 text-blue-600 hover:bg-gray-200"
                    id="popular-searches-button">
                    Popular Searches
                </button>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('components.font-end.footer')

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBtn = document.getElementById('search-button');
            const searchInput = document.getElementById('search-input');
            const popularBtn = document.getElementById('popular-searches-button');

            searchBtn.addEventListener('click', function() {
                const query = searchInput.value;
                if (query) {
                    fetch(`/search?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => alert('Search successful!'))
                        .catch(error => console.error('Error:', error));
                } else {
                    alert('Please enter a search term.');
                }
            });

            popularBtn.addEventListener('click', function() {
                fetch('/popular-searches')
                    .then(response => response.json())
                    .then(data => alert('Popular searches loaded!'))
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
</x-app-layout>
