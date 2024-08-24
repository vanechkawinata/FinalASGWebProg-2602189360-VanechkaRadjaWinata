<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">꧁༒☬Ｃㄖℕℕⓔ匚𝐭𝔣ℝ𝒾ⓔℕĐ™☬༒꧂</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('setAktif')" aria-current="page" href="{{ route('user.index') }}">@lang('layout.home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('setAktifR')" href="{{ route('friend-request.index') }}">@lang('layout.request')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('setAktifF')" href="{{ route('friend.index') }}">@lang('layout.friends')</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('locale', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('locale', 'id') }}">Bahasa Indonesia</a></li>
                        </ul>
                    </div>

                    @guest
                        <a href="/login" class="btn btn-outline-secondary me-2">@lang('layout.login')</a>
                        <a href="/register" class="btn btn-outline-warning">@lang('layout.register')</a>
                    @endguest

                    @auth
                        <button class="btn btn-outline-primary position-relative me-2 @yield('setAktifN')" type="button" onclick="window.location='{{ route('notifications.index') }}'">
                            <i class="bi bi-bell"></i> @lang('layout.notification')
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->unreadNotifications->count() }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">@lang('layout.logout')</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
