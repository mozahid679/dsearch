<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Persons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .search-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="search-container">
            <h1 class="mb-4 text-center">Search Persons</h1>
            <form action="{{ route('person.search') }}" method="GET">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="person_name">Person Name</label>
                    <input class="form-control" id="person_name" name="person_name" type="text"
                        value="{{ old('person_name') }}" placeholder="Enter person's name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="fathers_name">Father's Name</label>
                    <input class="form-control" id="fathers_name" name="fathers_name" type="text"
                        value="{{ old('fathers_name') }}" placeholder="Enter father's name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="national_id">National ID</label>
                    <input class="form-control" id="national_id" name="national_id" type="text"
                        value="{{ old('national_id') }}" placeholder="Enter national ID">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="company_name">Company Name</label>
                    <input class="form-control" id="company_name" name="company_name" type="text"
                        value="{{ old('company_name') }}" placeholder="Enter company name">
                </div>
                <button class="btn btn-primary w-100" type="submit">Search</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <strong>Error:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
