<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/layouts/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <header>
            <div class="container-fluid" style="height:4px; background-color: rgb(244 128 36)">
            </div>
            <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm p-0">
                <div class="container">
                <div class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                        <span class="navbar-toggler-icon"></span>
                      </a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('/home')}}">Home</a>
                        <small class="dropdown-header">PUBLIC</small>
                        <a class="dropdown-item ml-3" href="{{url('/questions')}}">Questions</a>
                        <a class="dropdown-item ml-3" href="#">Users</a>
                      </div>
                </div>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('image/logo.png') }}" style="width:160px; height:37px;" alt="logo stackoverflow">
                    </a>

                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form class="form-inline">
                                    <button type="submit" disabled><i class="fa fa-search"></i></button>
                                    <input class="form-control" type="text" autocomplete="off" maxlength="240" size="60" placeholder="Search..." aria-label="Search">
                                </form>
                            </li>

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="btn btn-info btn-sm mr-1" href="{{ route('login') }}">{{ __('Log in') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                </div>
            </nav>
        </header>

        <main class="py-4 myMain">
            @yield('content')
        </main>
    </div>
</body>
</html>
