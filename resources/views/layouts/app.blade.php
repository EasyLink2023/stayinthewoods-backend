<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    @stack('css')
    <style>
    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;charset=UTF8,%3Csvg xmlns%3D%22http://www.w3.org/2000/svg%22 viewBox%3D%220 0 30 30%22%3E%3Cpath stroke%3D%22rgba%28255, 255, 255, 1%29%22 stroke-width%3D%222%22 d%3D%22M4 7h22M4 15h22M4 23h22%22/%3E%3C/svg%3E');
    }
</style>
</head>

<body>
    <div id="app">
        @if (Route::currentRouteName() != 'login')
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #3f1324">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        <img src="https://www.stayinthewoods.com/assets/image/logo_white.svg" alt="Colour Woodland Logo" style="width: 200px">
                    </a>
                    <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto ">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item mb-2">
                                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                @if (Route::has('event.index'))
                                    <li class="nav-item me-4 mb-1">
                                        <a class="text-light btn btn-primary" href="{{ route('event.index') }}">{{ __('Event') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('rfps.index'))
                                    <li class="nav-item me-3">
                                        <a class="text-light btn btn-primary" href="{{ route('rfps.index') }}">{{ __('RFPS') }}</a>
                                    </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link text-light dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
        @stack('scipts')
    </div>
</body>

</html>
