<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee – @yield('title','Dashboard')</title>
  {{-- Vite will inject Bootstrap CSS & JS --}}
  @vite(['resources/css/app.css','resources/js/app.js',])
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('employee.dashboard') }}">
        Task Management System
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#employeeNavbar" aria-controls="employeeNavbar"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="employeeNavbar">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
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
