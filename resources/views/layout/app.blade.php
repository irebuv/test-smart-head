<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'Laravel') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="d-flex flex-column min-vh-100 bg-light ">
  <header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom container">
    <div class="col-md-3 mb-2 mb-md-0"> <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
        Test </a> </div>
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
      <li><a href="#" class="nav-link px-2">Features</a></li>
      <li><a href="#" class="nav-link px-2">Pricing</a></li>
      <li><a href="#" class="nav-link px-2">FAQs</a></li>
      <li><a href="#" class="nav-link px-2">About</a></li>
    </ul>
    @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4">
        @auth
          <a href="{{ url('/admin') }}" class="btn btn-primary">
            Admin panel
          </a>
        @else
          <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
            Log in
          </a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-primary">
              Register
            </a>
          @endif
        @endauth
      </nav>
    @endif
  </header>
  <main class="d-flex">
    @yield('content')
  </main>

  <footer class="text-center">
    footer
  </footer>
</body>

</html>
