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
        Admin panel </a> </div>
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{route('admin')}}" class="nav-link px-2">Tickets</a></li>
      <li><a href="{{route('customers')}}" href="#" class="nav-link px-2">Customers</a></li>
      <li><a href="{{route('users')}}" class="nav-link px-2">Users</a></li>
      <li><a href="#" class="nav-link px-2">Permissions</a></li>
    </ul>
    @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4">
        @auth
          <div class="d-flex flex-col gap-2">
            <a href="{{ url('/') }}" class="btn btn-primary">
              Home
            </a>
            <form action="{{ route('logout') }}" method="post" class="m-0">
              @csrf
              <button class="btn">
                Logout
              </button>
            </form>
          </div>
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
