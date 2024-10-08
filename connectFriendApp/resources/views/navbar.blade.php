<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ConnectFriend</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('activeHome')" href="{{route('user.index')}}">@lang('navbar.Home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeRequest')" href="{{route('friend-request.index')}}">@lang('navbar.Request')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeMessage')" href="{{route('friend.index')}}">@lang('navbar.Friend')</a>
                    </li>
                </ul>
                @if (Auth::check())
                    <div class="d-flex align-items-center">
                        <span class="text-light me-3">Welcome, {{ Auth::user()->name }}!</span>
                        <div class="d-flex text-center align-items-center text-white gap-1 px-3">
                            <a href="{{ route('lang.switch', 'en') }}">English</a> |
                            <a href="{{ route('lang.switch', 'id') }}">Indonesian</a>
                        </div>                         
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">@lang('navbar.Logout')</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex">
                        <div class="d-flex text-center align-items-center text-white gap-1 px-3">
                            <a href="{{ route('lang.switch', 'en') }}">English</a> |
                            <a href="{{ route('lang.switch', 'id') }}">Indonesian</a>
                        </div>                        
                        <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">@lang('navbar.Login')</a>
                        <a href="{{ url('/register') }}" class="btn btn-primary">@lang('navbar.Register')</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <main class="container mt-5">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>