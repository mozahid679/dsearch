<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anti-Corruption Commission Search Portal</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Custom Styling */
        .hero {
            background-image: url('/images/justice-bg.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .search-input {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .search-input:focus {
            border-color: #1e90ff;
            box-shadow: 0 0 10px rgba(30, 144, 255, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .search-button {
            background-color: #1e90ff;
            color: #fff;
            transition: background 0.3s ease;
        }

        .search-button:hover {
            background-color: #1c86ee;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    @include('components.font-end.header')

    <!-- Hero Section -->
    <div class="hero flex h-screen items-center justify-center">
        <div class="overlay"></div>
        <div class="hero-content mx-auto max-w-lg rounded-lg bg-white bg-opacity-90 p-10 text-center shadow-lg">
            <h1 class="mb-4 text-4xl font-bold text-blue-800">Welcome to the Anti-Corruption Commission Search Portal
            </h1>
            <p class="mb-6 text-lg text-gray-700">Providing transparent access to public data and resources.</p>

            <div class="relative">
                <input class="search-input w-full rounded-lg border px-4 py-3 focus:outline-none" id="search-input"
                    type="text" placeholder="Search by National ID, Name...">
                <button class="search-button absolute right-0 top-0 rounded-r-lg px-4 py-3" id="search-button">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500">Use advanced options for a detailed search.</p>

            <div class="mt-6">
                <button class="rounded-md bg-gray-100 px-4 py-2 text-blue-600 hover:bg-gray-200"
                    id="popular-searches-button">Popular Searches</button>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.font-end.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // AJAX Search Request
            $('#search-button').on('click', function() {
                var query = $('#search-input').val();
                if (query) {
                    $.ajax({
                        url: '/search', // Replace with actual route
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            alert('Search successful!'); // Placeholder for actual handling
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                } else {
                    alert('Please enter a search term.');
                }
            });

            // Fetch Popular Searches with AJAX
            $('#popular-searches-button').on('click', function() {
                $.ajax({
                    url: '/popular-searches', // Replace with actual route
                    method: 'GET',
                    success: function(response) {
                        alert('Popular searches loaded!'); // Placeholder for actual handling
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>
