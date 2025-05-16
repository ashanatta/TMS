<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee – @yield('title', 'Dashboard')</title>
    {{-- Vite will inject Bootstrap CSS & JS --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
    <!-- in your <head> after Vite’s CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('employee.dashboard') }}">
                Employee Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#employeeNavbar"
                aria-controls="employeeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="employeeNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    
                   
                    <div class="dropdown">

                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employee.tasks') }}">My-Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employee.dashboard') }}">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white p-0"
                                style="text-decoration: none;">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container mb-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-auto bg-primary text-white text-center py-3">
        <small>&copy; {{ date('Y') }} Your Company. All rights reserved.</small>
    </footer>

</body>

</html>
