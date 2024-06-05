<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AgroGestor') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo-navegador.png') }}">

    <style>
        .logo-img {
            height: 50px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .app-name {
            margin-left: 10px;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .nav-item-right {
            margin-left: auto;
        }

        .sidebar {
            height: 100vh;
            /* Para que el sidebar ocupe toda la altura de la pantalla */
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="logo-img">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="dropdown nav-item">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLang" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @switch(app()->getLocale())
                            @case('en')
                                <img src="{{ asset('img/uk-flag.svg') }}" alt="UK Flag"> English
                                @break
                            @case('es')
                                <img src="{{ asset('img/es-flag.svg') }}" alt="Spain Flag"> Español
                                @break
                        @endswitch
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownLang">
                        <a class="dropdown-item" href="{{ route('lang.switch', 'es') }}"><img src="{{ asset('img/es-flag.svg') }}" alt="Spain Flag"> Español</a>
                        <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}"><img src="{{ asset('img/uk-flag.svg') }}" alt="UK Flag"> English</a>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto nav-item-right">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('actions.log_out') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('dashboard') }}">
                                    @lang('actions.home')
                                </a>
                            </li>
                            @role('admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('usuarios.crear') }}">
                                        {{ __('Create Users') }}
                                    </a>
                                </li>
                            @endrole
                            @role('jefe')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('group.index') }}">
                                        {{ __('View Groups') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('group.create') }}">
                                        {{ __('Create Group') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('activity.create') }}">
                                        {{ __('Create Activities') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('activity.index') }}">
                                        {{ __('View Activities') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('harvest.register') }}">
                                        {{ __('Register Harvest') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('product.register') }}">
                                        {{ __('Add Product') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('report.index') }}">
                                        {{ __('Generate Reports') }}
                                    </a>
                                </li>
                            @endrole
                            @role('trabajador')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('task.history') }}">
                                        {{ __('Activity History') }}
                                    </a>
                                </li>
                            @endrole
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rains.index') }}">
                                    {{ __('View Rainfall') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rains.create') }}">
                                    {{ __('Record Rainfall') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
