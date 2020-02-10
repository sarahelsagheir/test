<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

<link href="{{ asset('css/preview.css') }}" rel="stylesheet">

</head>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('style')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{route('product.index')}}" class="nav-link">Store</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('borrow.index')}}" class="nav-link">Borrow</a>
                        </li>
                    </ul>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a href="{{ route('cart.show')}}" class="nav-link">
                                <span class="fas fa-shopping-cart">
                                    My Cart ( {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }})
                                </span>
                            </a>
                        </li>

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
                                <a class="dropdown-item" href="{{route('profile')}}">Profile Settings</a>
                                <a class="dropdown-item" href="{{route('changePassword')}}">Change password</a>
                                <a class="dropdown-item" href="{{route('profileAvatar')}}">Upload Profile Picture</a></a>
                                <a href="{{ route('order.index') }}" class="dropdown-item">Orders <i class="fas fa-grip-horizontal ml-2"></i></a>
                                <a class="dropdown-item" href="{{route('books')}}">my book</a>
                                <a class="dropdown-item" href="{{route('addBook')}}">Share book</a>
                                <a class="dropdown-item" href="{{route('sharedBook')}}">Shared book</a>
                                <a class="dropdown-item" href="{{'/showRate/'.auth::user()->id}}">my Rate</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                       {{ __('Logout') }}
                                    <i class="fas fa-sign-out-alt ml-2"></i>

                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown" >

<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

    <span class="glyphicon glyphicon-globe"></span> Notifications <span class="badge">{{count(auth::user()->unreadNotifications)}}</span>

</a>
<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

    <li>
        @foreach(auth()->user()->unreadNotifications as $notification)
    @include('notification.'.Str::snake(class_basename($notification->type)))
   @endforeach
    </li>
</ul>
</li>


                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('sweetalert::alert')

    @yield('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/096ac12684.js" crossorigin="anonymous"></script>

</body>

</html>