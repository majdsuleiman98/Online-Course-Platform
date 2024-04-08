<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- sweetalert --}}
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>




    {{-- toastr --}}
    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <title>{{ config('app.name', 'Coursat') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <style>
        .shopping-card {
            position: relative;
        }
        .shopping-card::before {
            content: "{{session()->has('cart')?session()->get('cart')->totalQty:'0'}}";
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: white;
            border-radius: 50%;
            color: #1c5996;
            top: -4px;
            right: 5px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;

        }
    </style>

</head>

<body class="{{ $class ?? '' }}">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
        <div class="container-fluid">

            @auth
            <a class="navbar-brand" href="{{route('home')}}"><span class="logo">MC</span> Coursat</a>
            @endauth
            @guest
            <a class="navbar-brand" href="/"><span class="logo">MC</span> Coursat</a>
            @endguest
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse links" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 search-form" action="{{route('search')}}" method="get">
                    <input name="search" placeholder="find your course..." class="form-control mr-sm-2" type="search"
                        aria-label="Search">
                </form>

                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @endauth
                    @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('welcome')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('all-courses')}}">All Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('favorilerim.index')}}"><i class="fas fa-heart"></i> Favorilerim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link shopping-card" href="{{route('cart.show')}}">Cart<i class="fas fa-cart-plus"></i></a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                            <i class="fas fa-key-25"></i>
                            <span class="nav-link-inner--text">{{ __('Login') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                            <i class="fas fa-key-25"></i>
                            <span class="nav-link-inner--text">{{ __('register') }}</span>
                        </a>
                    </li>
                    @endguest
                    <li class="nav-item dropdown">
                        <a class="nav-link @auth dropdown-toggle @endauth" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @auth
                                {{ \Str::limit(auth()->user()->name, 10) }}
                            @endauth

                        </a>
                        @auth
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('user-profile')}}">Profile</a>
                                <a class="dropdown-item" href="{{route('my-courses')}}">My Courses</a>
                                <form id="logout-form" class="dropdown-item" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    {{-- <input type="submit" value="logout"> --}}
                                </form>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                    <span>{{ __('Logout') }}</span>
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        @endauth
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    @yield('content')


    {{-- @include('includes.footer') --}}

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script src="/js/script.js"></script>
    @include("includes.toastr")
</body>
</html>
