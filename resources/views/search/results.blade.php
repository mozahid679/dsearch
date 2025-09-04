<x-app-layout>
    @props(['results'])

    <div class="mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2 xl font-bold text-gray-800">Person Search Results</h1>

            <div class="mt-4 flex items-center gap-4 sm:mt-0">
                <form class="flex items-center gap-2" method="GET" action="{{ request()->url() }}">
                    <label class="text-gray-700" for="perPage">Items:</label>
                    <select
                        class="rounded-md border border-blue-300 bg-white text-blue-700 shadow-sm hover:bg-blue-50 focus:border-blue-500 focus:ring-blue-500"
                        id="perPage" name="per_page" onchange="this.form.submit()">
                        @foreach ([10, 25, 50, 100, 200, 500] as $size)
                            <option class="bg-white text-blue-700" value="{{ $size }}"
                                {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                        @endforeach
                    </select>

                    @foreach (request()->except('per_page') as $key => $value)
                        <input name="{{ $key }}" type="hidden" value="{{ $value }}">
                    @endforeach
                </form>

                <a class="inline-flex items-center rounded-md bg-gray-500 px-3 py-2 text-white hover:bg-gray-600"
                    href="{{ route('person.search.form') }}">
                    <svg class="mr-2 size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    Back to Search
                </a>
            </div>
        </div>

        @if ($results->count() > 0)
            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200" id="resultsTable">
                    <thead class="bg-gray-100 text-left font-semibold text-gray-700">
                        <tr>
                            <th class="px-4 py-3"><input id="select-all" type="checkbox"></th>
                            <th hidden>ID</th>
                            <th class="px-4 py-3">Reg No</th>
                            <th class="px-4 py-3">Company</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Father/Husband</th>
                            <th class="px-4 py-3">NID</th>
                            <th class="px-4 py-3">Present Address</th>
                            <th class="px-4 py-3">Permanent Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @foreach ($results as $person)
                            <tr>
                                <td class="px-4 py-2"><input name="selectedRows[]" type="checkbox"
                                        value="{{ $person->CLIENT_ID }}"></td>
                                <td hidden>{{ $person->id ?? '' }}</td>
                                <td class="px-4 py-2">{{ $person->REGISTRATION_NO }}</td>
                                <td class="px-4 py-2">{{ $person->COMPANY_NAME }}</td>
                                <td class="px-4 py-2">{{ $person->PERSON_NAME }}</td>
                                <td class="px-4 py-2">{{ $person->FATHERS_NAME }}</td>
                                <td class="px-4 py-2">{{ $person->NATIONAL_ID }}</td>
                                <td class="whitespace-pre-line px-4 py-2">{{ $person->PRESENT_ADDRESS }}</td>
                                <td class="whitespace-pre-line px-4 py-2">{{ $person->PERMANENT_ADDRESS }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2 rounded bg-white p-4 shadow">
                {{ $results->appends(['per_page' => request('per_page')])->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @else
            <div class="my-6 rounded bg-red-50 px-6 py-36 font-medium text-red-700">
                No records found matching your search criteria.
            </div>
        @endif

        <div class="mt-6 flex flex-col gap-4 sm:flex-row">
            @if ($results->count() > 0)
                <button
                    class="inline-flex items-center justify-center rounded-md bg-green-600 px-4 py-2 font-medium text-white hover:bg-green-700"
                    type="submit">
                    Download Selected as Excel
                </button>
            @endif

            <a class="inline-flex items-center rounded-md bg-gray-500 px-3 py-2 font-medium text-white hover:bg-gray-600"
                href="{{ route('person.search.form') }}">
                <svg class="mr-2 size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                Back to Search
            </a>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#resultsTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true
                });

                $('#select-all').on('change', function() {
                    $('input[name="selectedRows[]"]').prop('checked', this.checked);
                });
            });
        </script>
    @endpush
</x-app-layout>
