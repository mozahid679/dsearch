{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .results-container { background-color: white; padding: 2rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .table thead th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="results-container">
            <h1 class="text-center">Search Results</h1>
            <form action="{{ route('person.search.export') }}" method="POST">
                @csrf
                <table class="table table-hover table-bordered" id="resultsTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Registration No</th>
                            <th>Company Name</th>
                            <th>Client ID</th>
                            <th>Person Name</th>
                            <th>Father's Name</th>
                            <th>National ID</th>
                            <th>Birth Date</th>
                            <th>Present Address</th>
                            <th>Permanent Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $result)
                            <tr>
                                <td><input type="checkbox" name="selectedRows[]" value="{{ $result->client_id }}"></td>
                                <td>{{ $result->registration_no }}</td>
                                <td>{{ $result->company_name }}</td>
                                <td>{{ $result->client_id }}</td>
                                <td>{{ $result->person_name }}</td>
                                <td>{{ $result->fathers_name }}</td>
                                <td>{{ $result->national_id }}</td>
                                <td>{{ $result->birth_date }}</td>
                                <td>{{ $result->present_address }}</td>
                                <td>{{ $result->permanent_address }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="10" class="text-center">No results found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-3">Download Selected as Excel</button>
                <a href="{{ route('person.search.form') }}" class="btn btn-secondary mt-3">Back to Search</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resultsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true
            });

            // Select all checkboxes
            $('#select-all').on('change', function() {
                $('input[name="selectedRows[]"]').prop('checked', this.checked);
            });
        });
    </script>
</body>
</html> --}}

{{-- 
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="justify-content-between align-items-center d-flex mb-3 mt-4">
            <h1 class="flex-start">Person Search Results</h1>
            <div class="d-flex justify-content-between gap-2 rounded border p-2">
                <div class="rounded">
                    <form class="d-flex align-items-end gap-2" method="GET" action="{{ request()->url() }}">
                        <label class="form-label align-items-end text-black" for="perPage">Items:</label>
                        <select class="form-select-sm align-items-middle form-select mb-0" id="perPage" name="per_page"
                            style="max-width: 90px" onchange="this.form.submit()">
                            @foreach ([10, 25, 50, 100, 200, 500] as $size)
                                <option value="{{ $size }}"
                                    {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>

                        @foreach (request()->except('per_page') as $key => $value)
                            <input name="{{ $key }}" type="hidden" value="{{ $value }}">
                        @endforeach
                    </form>
                </div>
                <a class="btn btn-secondary ms-2" href="{{ route('person.search.form') }}">
                    Back to Search
                </a>
            </div>

        </div>

        <div class="mt-3">
            {{ $results->links() }}
        </div>

        @if ($results->count() > 0)
            <div class="table-responsive">
                <table class="table-striped table">
                    <thead class="thead-dark">
                        <tr>
                            <th><input id="select-all" type="checkbox"></th>
                            <th hidden>ID</th>
                            <th>Reg No</th>
                            <th>Company</th>
                            <th>Name</th>
                            <th>Father/Husband</th>
                            <th>NID</th>
                            <th>Present Address</th>
                            <th>Permanent Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $person)
                            <tr>
                                <td><input name="selectedRows[]" type="checkbox" value="{{ $person->client_id }}"></td>
                                <td hidden>{{ $person->id }}</td>
                                <td>{{ $person->REGISTRATION_NO }}</td>
                                <td>{{ $person->COMPANY_NAME }}</td>
                                <td>{{ $person->PERSON_NAME }}</td>
                                <td>{{ $person->FATHERS_NAME }}</td>
                                <td>{{ $person->NATIONAL_ID }}</td>
                                <td>{{ nl2br($person->PRESENT_ADDRESS) }}</td>
                                <td>{{ nl2br($person->PERMANENT_ADDRESS) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $results->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No records found matching your search criteria.
            </div>
        @endif

        <button class="btn btn-success mt-3" type="submit">Download Selected as Excel</button>
        <a class="btn btn-secondary mt-3" href="{{ route('person.search.form') }}">Back to Search</a>
    </div>
@endsection

<script>
    $(document).ready(function() {
        $('#resultsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });

        $('#select-all').on('change', function() {
            $('input[name="selectedRows[]"]').prop('checked', this.checked);
        });
    });
</script> --}}


<x-app-layout>
    @props(['results'])

    <div class="mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-4xl font-bold text-gray-800">Person Search Results</h1>

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

        @if ($results->count() > 0)
            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200" id="resultsTable">
                    <thead class="bg-gray-100 text-left text-xl font-semibold text-gray-700">
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
                    <tbody class="divide-y divide-gray-200 text-xl text-gray-700">
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
            <div class="mt-6 rounded bg-blue-50 px-4 py-3 text-blue-700">
                No records found matching your search criteria.
            </div>
        @endif

        <div class="mt-6 flex flex-col gap-4 sm:flex-row">
            <button
                class="inline-flex items-center justify-center rounded-md bg-green-600 px-4 py-2 font-medium text-white hover:bg-green-700"
                type="submit">
                Download Selected as Excel
            </button>

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





{{-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .results-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="results-container">
            <h1 class="text-center">Search Results</h1>
            <form action="{{ route('person.search.export') }}" method="POST">
                @csrf
                <table class="table-hover table-bordered table" id="resultsTable">
                    <thead>
                        <tr>
                            <th><input id="select-all" type="checkbox"></th>
                            <th>Registration No</th>
                            <th>Company Name</th>
                            <th>Client ID</th>
                            <th>Person Name</th>
                            <th>Father's Name</th>
                            <th>National ID</th>
                            <th>Birth Date</th>
                            <th>Present Address</th>
                            <th>Permanent Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $result)
                            <tr>
                                <td><input name="selectedRows[]" type="checkbox" value="{{ $result->client_id }}"></td>
                                <td>{{ $result->registration_no }}</td>
                                <td>{{ $result->company_name }}</td>
                                <td>{{ $result->client_id }}</td>
                                <td>{{ $result->person_name }}</td>
                                <td>{{ $result->fathers_name }}</td>
                                <td>{{ $result->national_id }}</td>
                                <td>{{ $result->birth_date }}</td>
                                <td>{{ $result->present_address }}</td>
                                <td>{{ $result->permanent_address }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="10">No results found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <button class="btn btn-success mt-3" type="submit">Download Selected as Excel</button>
                <a class="btn btn-secondary mt-3" href="{{ route('person.search.form') }}">Back to Search</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resultsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true
            });

            // Select all checkboxes
            $('#select-all').on('change', function() {
                $('input[name="selectedRows[]"]').prop('checked', this.checked);
            });
        });
    </script>
</body>

</html> --}}
