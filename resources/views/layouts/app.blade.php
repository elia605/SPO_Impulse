<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?169"></script>
    <script type="text/javascript">
        function VK_Widget_Init(){
            document.getElementById('vk_widget').innerHTML = '<div id="vk_groups"></div>';
            VK.Widgets.Group("vk_groups", {mode: 0, width: "auto", height: "241"}, 94915668);
        }
        window.addEventListener('load', VK_Widget_Init, false);
        window.addEventListener('resize', VK_Widget_Init, false);
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body style="background-image: url({{ asset('storage/img/templates/ranger-4df6c1b6.png') }}) ; /* Путь к фоновому изображению */
background-attachment: fixed; background-size: cover;">
<div id="app">
    <nav class="navbar fixed-top navbar-expand-md navbar-light shadow-sm" style="background: linear-gradient(180deg, #039895 90%, #014443 10%)">
        <div class="container">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img src="{{asset('storage/img/logo.png')}}" width="30" height="30" class="d-inline-block align-top"
                     alt="">
                {{ config('app.name', 'СПО «Импульс»') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.users')}}">Пользователи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('org.members')}}">Бойцы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('org.requests')}}">Заявки @if($reqs > 0)<span class="badge badge-danger">{{$reqs}}</span>@endif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('org.actions')}}">Мероприятия</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('org.documents')}}">Документы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('org.news')}}">Новости</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('org.carousel')}}">Карусель</a>
                            </li>

                    @elseif(Auth::user()->isOrg())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('org.members')}}">Бойцы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('org.requests')}}">Заявки</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('org.actions')}}">Мероприятия</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Грамоты</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('org.news')}}">Новости</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('org.carousel')}}">Карусель</a>
                            </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('/')}}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('actions')}}">Мероприятия</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members')}}">Бойцы</a>
                        </li>
                        @endif
                        @endauth
                    @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('/')}}">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('actions')}}">Мероприятия</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('members')}}">Бойцы</a>
                            </li>
                        @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Вход</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @auth
                                    @if (Auth::user()->file !== null)
                                        <img src="{{asset('storage/img/profile/'.Auth::user()->file->name)}}" alt="Avatar" width="30px" class="rounded-circle">
                                    @else
                                        <img src="{{asset('storage/img/templates/noimage.jpg')}}" alt="Avatar" width="30px" class="rounded-circle">
                                    @endif
                                @endauth
                                {{ Auth::user()->name }}
                                    @if (Auth::user()->roles->first()->role === 'admin')
                                <span class="badge badge-danger">Админ</span>
                                        @elseif (Auth::user()->roles->first()->role === 'member')
                                        <span class="badge badge-success">Участник</span>

                                    @elseif (Auth::user()->roles->first()->role === 'org')
                                        <span class="badge badge-warning">Орг</span>

                                    @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('profile')}}">Настройки профиля</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выйти из профиля') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4" style="margin-top: 70px;">
        @yield('content')
    </main>
</div>
<footer class="container">
    <p class="float-right"><a href="#">Наверх</a></p>
    <p>© 2020 Галкова Э. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
</footer>
</body>
@livewireScripts
</html>
