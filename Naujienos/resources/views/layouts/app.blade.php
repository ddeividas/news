<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Deivido naujienos
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('home')}}">Admin panele</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="container">
            @auth
                @if(\Route::current()->getName() == 'news.index' || \Route::current()->getName() == 'news.filter')
                    @yield('content')
                @else
            <div class="row">
                <div style="border-right: 1px solid gray" class="col-2">
                    <div style="padding-top: 20px">
                        <div>
                            <a style="margin-top: 15px" class="btn btn-primary" href="{{route('news.create')}}">Sukurti naujiena</a>
                        </div>
                        <div>
                            <a style="margin-top: 15px" class="btn btn-primary" href="{{route('categories.create')}}">Sukurti kategorija</a>
                        </div>
                        @yield('asd')
                    </div>
                </div>
                <div style="padding-left: 0px" class="col-10">
                    <div style="border-bottom: 1px solid gray" class="top_navbar">
                        <a style="margin:15px;"class="btn btn-secondary" href="{{route('home')}}">Straipsniai</a>
                        <a style="margin:15px;"class="btn btn-secondary" href="{{route('categories.index')}}">Kategorijos</a>
                        <a style="margin:15px;"class="btn btn-secondary" href="{{route('comments.index')}}">Visi komentarai</a>
                        <a style="margin:15px;"class="btn btn-secondary" href="{{route('users.index')}}">Vartotojai</a>
                        <a style="margin:15px;"class="btn btn-success" href="{{route('user.profile', Auth::user()->id)}}">Mano profilis</a>
                        <a style="margin:15px;"class="btn btn-warning" href="{{route('tasks.index')}}">Užduotys</a>
                    </div>
                    <div>
                        @yield('content')
                    </div>
                </div>
            </div>
                @endif
            @else
                @yield('content')
            @endauth
        </main>
    </div>
</body>
</html>
