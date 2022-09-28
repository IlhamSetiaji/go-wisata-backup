<!DOCTYPE html>
<html lang="en">

<head>


    <title>GoWisata. </title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/GoWisata.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>





{{-- <nav class="navbar navbar-light">

        </nav> --}}
<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <div class="container d-block">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-map-marker"></i>
                    GoWisata.
                </a>

            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown me-1">
                        {{-- <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Mail</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">No new mail</a></li>
                                </ul> --}}
                    </li>
                    <li class="nav-item dropdown me-3">
                        {{-- <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Notifications</h6>
                                    </li>
                                    <li><a class="dropdown-item">No notification available</a></li>
                                </ul> --}}
                    </li>
                </ul>
                <div class="dropdown">

                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        @guest
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    {{-- <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                    <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->role->name }}</p> --}}
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        Login / Register

                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
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
                        </ul>
                    @else
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->role->name }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    @if (Auth::user()->image == null)
                                        <img alt="image" class="mr-3 rounded-circle" width="50"
                                            src="{{ asset('images') }}/user.jpg">
                                    @else
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset('images') }}/{{ Auth::user()->image }}">

                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}!</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/profile') }}"><i
                                        class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pesananku') }}"><i
                                        class="fas fa-shopping-basket"></i> &nbsp;
                                    Pesananku</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @endguest

                </div>
            </div>
        </div>
    </nav>
</header>

<div id="main-content">



    @yield('content')








    </body>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        function reloadpage() {
            location.reload()
        }
    </script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('assets/js/main.js') }}"></script>


</html>
