<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MojForum - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand pb-1" href="{{ url('/') }}">
                   <img style="width:165px;" src="{{asset('storage/mojforum_logo_200x39.png')}}" alt="MojForum Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link {{url()->current() == route('naslovna') ? 'active' : null }}" href="{{ route('naslovna') }}"><i class="fas fa-home" style="font-size:18px;"></i> Naslovna</a></li>
                        <li><a class="nav-link {{url()->current() == route('zadnje.teme') ? 'active' : null }}" href="{{ route('zadnje.teme') }}"><i class="fas fa-list-alt" style="font-size:18px;"></i> Zadnje teme</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registeriraj se') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->naziv_slike == 'default.jpg')
                                        <img class="rounded rounded-circle mr-2" style="height:45px;" src="{{asset('storage/'.Auth::user()->naziv_slike)}}"> 
                                    @else
                                    <img class="rounded rounded-circle mr-2" style="height:45px;" src="{{asset('storage/'.Auth::user()->slug.'/'.Auth::user()->naziv_slike)}}">
                                    @endif
                               
                                {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="{{route('panel')}}" class="dropdown-item">Profil</a>
                                    @if (Auth::user()->is_admin)
                                    <a href="{{route('admin.panel')}}" class="dropdown-item">Admin panel</a>   
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

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

        <div class="container-fluid mt-4 mb-1">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            	@endif
        </div>
        <main class="py-1" style="min-height: 85vh;">
            @yield('content')
        </main>
    </div>
    <div class="container-fluid">
        <div class="row bg-light shadow p-3">
            <div class="col mt-2 text-secondary text-center">
                <p class="h6"><a class="text-dark font-weight-bold" href="{{route('naslovna')}}">MojForum</a>&copy  {{date('Y').'.'}} Sva prava pridržana.</p>
            </div>
        </div>	
    </div>
</body>
</html>
