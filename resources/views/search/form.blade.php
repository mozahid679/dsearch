<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('🔍 Person Search') }}
        </h2>
    </x-slot>

    <section class="relative isolate overflow-hidden bg-gradient-to-tr from-blue-100 via-white to-emerald-100 py-24">
        <div class="mx-auto max-w-4xl">
            <div class="rounded-xl border border-gray-200 bg-white p-12 shadow-lg">
                <form class="space-y-8" id="searchForm" method="GET" action="{{ route('person.search') }}">
                    {{-- Person Name --}}
                    <div>
                        <label class="block font-semibold text-gray-700" for="person_name">
                            {{ __("Person's Name") }}
                        </label>
                        <input
                            class="mt-3 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            id="person_name" name="person_name" type="text" value="{{ request('person_name') }}"
                            placeholder="Enter person's name" />
                    </div>

                    {{-- Father's Name --}}
                    <div>
                        <label class="block font-semibold text-gray-700" for="fathers_name">
                            {{ __("Father's Name") }}
                        </label>
                        <input
                            class="mt-3 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            id="fathers_name" name="fathers_name" type="text" value="{{ request('fathers_name') }}"
                            placeholder="Enter father's name" />
                    </div>

                    {{-- National ID --}}
                    <div>
                        <label class="block font-semibold text-gray-700" for="national_id">
                            {{ __('National ID') }}
                        </label>
                        <input
                            class="mt-3 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            id="national_id" name="national_id" type="text" value="{{ request('national_id') }}"
                            placeholder="Enter national ID" />
                    </div>

                    {{-- Company Name --}}
                    <div>
                        <label class="block font-semibold text-gray-700" for="company_name">
                            {{ __('Company Name') }}
                        </label>
                        <input
                            class="mt-3 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            id="company_name" name="company_name" type="text" value="{{ request('company_name') }}"
                            placeholder="Enter company name" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-center gap-4 justify-self-end">
                        <button
                            class="w-full rounded bg-gray-600 px-6 py-2 text-white hover:bg-gray-700 disabled:cursor-not-allowed disabled:opacity-50"
                            id="resetButton" type="reset" disabled>
                            {{ __('Reset') }}
                        </button>

                        <button
                            class="w-full rounded bg-cyan-600 px-6 py-2 text-white hover:bg-cyan-700 disabled:cursor-not-allowed disabled:opacity-50"
                            id="searchButton" type="submit" disabled>
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="mt-8 rounded-lg border border-red-300 bg-red-50 px-6 py-5 text-red-700">
                        <strong class="block text-xl font-bold">{{ __('Error') }}</strong>
                        <ul class="mt-3 list-inside list-disc space-y-2 text-lg">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('searchForm');
            const searchButton = document.getElementById('searchButton');
            const resetButton = document.getElementById('resetButton');
            const inputs = form.querySelectorAll('input[type="text"]');

            function toggleButtons() {
                let hasValue = false;
                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        hasValue = true;
                    }
                });
                searchButton.disabled = !hasValue;
                resetButton.disabled = !hasValue;
            }

            // When reset is clicked, clear inputs and disable both buttons again
            resetButton.addEventListener('click', function() {
                inputs.forEach(input => input.value = '');
                toggleButtons();
            });

            inputs.forEach(input => {
                input.addEventListener('input', toggleButtons);
            });

            toggleButtons();
        });
    </script>
</x-app-layout>
