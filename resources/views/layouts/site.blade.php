<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laravel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('css')
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><small>Laravel App</small></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link {{ Request::path() == '/' ? 'active': '' }}" aria-current="page" href="{{ route('homepage') }}">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'about' ? 'active': '' }}" href="{{ route('about-us') }}">About</a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'admin/posts' ? 'active': '' }}" href="{{ route('admin.posts.index') }}">Posts</a>
              </li>

            </ul>

                @auth()
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Dashboard</a> &nbsp;
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a> &nbsp;
                    <a href="{{ route('register') }}" class="btn btn-outline-info">Register</a>
                @endauth


          </div>
        </div>
    </nav>


    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @yield('scripts')

</body>
</html>
