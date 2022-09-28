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
<div id="app">
    <div id="main" class="layout-horizontal">
        <header class="mb-5">
            <div class="header-top">
                <div class="container">
                    <div class="logo">

                        {{-- <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/logo.png') }}"
                                alt="Logo" srcset=""></a> --}}
                    </div>
                    <div class="logo">

                    </div>
                    <div class="logo">

                    </div>
                    <div class="logo">

                    </div>
                    <div class="logo">

                    </div>
                    <div class="logo">

                    </div>
                    <div class="logo">

                    </div>
                    <div class="logo">


                    </div>
                    <div class="logo">
                        @guest
                            <a href="{{ url('/') }}">
                                <button class="btn btn-outline-primary me-1 mb-1">Home</button>
                            </a>
                            <a href="{{ route('login') }}">
                                <button class="btn btn-outline-primary me-1 mb-1">Login</button>
                            </a>
                        @else
                            <a href="{{ url('/profile') }}">
                                <button class="btn btn-outline-primary me-1 mb-1">{{ Auth::user()->name }}</button>
                            </a>
                            <a href="{{ route('logout') }}">
                                <button class="btn btn-outline-primary me-1 mb-1"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>

                        @endguest

                    </div>
                    <div class="header-top-right">

                        <!-- Burger button responsive -->
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                    </div>


                </div>
            </div>
            <nav class="main-navbar">
                <div class="container">
                    <ul>



                        <li class="menu-item  ">
                            <a href="{{ url('/') }}" class='menu-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        {{-- <li class="menu-item  ">
                            <a href="" class='menu-link'>
                                <i class="fas fa-child"></i>
                                <span>Event</span>
                            </a>
                        </li> --}}
                        <?php
                        $temp = App\Models\Tempat::get();
                        
                        ?>
                        <li class="menu-item  has-sub">
                            <a href="{{ url('/event') }}" class='menu-link'>
                                <i class="bi bi-table"></i>
                                <span>Event</span>
                            </a>
                            <div class="submenu ">
                                <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                <div class="submenu-group-wrapper">


                                    <ul class="submenu-group">
                                        @foreach ($temp as $key => $value)
                                            @if (App\Models\Kegiatan::where('tempat_id', $value->id)->where('status', 1)->exists())
                                                <li class="submenu-item  ">
                                                    <a href="{{ url('/event', [$value->slug]) }}"
                                                        class='submenu-link'>{{ $value->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach





                                </div>
                            </div>
                        </li>



                    </ul>
                </div>
            </nav>

        </header>











        @yield('content')
    </div>
</div>







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

<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('assets/js/pages/horizontal-layout.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>



</html>
