<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Go Wisata</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    {{-- <link type="text/css" rel="stylesheet" href="{{ asset('auth/user/css/bootstrap.min.css') }}" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('auth/user/css/style.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('auth/style.css') }}" /> --}}

    <!--Peralatan -->
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    {{-- <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
    @include('sweetalert::alert')

    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row isi">
                    <div class="col-md-6 col-lg-4">
                        <div class="booking-form">
                            <a href="/" class="btn btn-primary">
                                Back to App
                            </a>
                            <div class="tabs mt-2">

                                <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home-justified" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">Login</button>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile-justified" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false">Register</button>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade show active" id="home-justified" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="text-center">
                                                <b>
                                                    <h2 class="fw-bolder">Login</h2>
                                                </b>
                                            </div>
                                            <span class="form-label">Email</span>
                                            <input placeholder="Email" id="email" type="email"
                                                class="form-control" name="email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus>
                                            <div class="mt-3">
                                                <span class="form-label">Password</span>
                                                <input placeholder="Password" id="password" type="password"
                                                    class="form-control" name="password" required
                                                    autocomplete="current-password">
                                            </div>
                                            <div class="d-flex justify-content-between mt-4">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}"> Lupa Password?</a>
                                                @endif
                                                <input type="submit" class="btn btn-primary" value="Sign up" />
                                            </div>

                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile-justified" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="text-center">
                                                <b>
                                                    <h2 class="fw-bolder">Register</h2>
                                                </b>
                                            </div>
                                            <div class="mt-3">
                                                <span class="form-label">Nama</span>
                                                <input placeholder="Nama" id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}" required
                                                    autocomplete="name" autofocus>
                                            </div>
                                            <div class="mt-3">
                                                <span class="form-label">Email</span>
                                                <input placeholder="Email" id="email" type="email"
                                                    class="form-control" name="email" value="{{ old('email') }}"
                                                    required autocomplete="email" autofocus>
                                            </div>
                                            <div class="mt-3">
                                                <span class="form-label">Password</span>
                                                <input placeholder="Password" id="password" type="password"
                                                    class="form-control" name="password" required
                                                    autocomplete="current-password">
                                            </div>
                                            <div class="mt-3">
                                                <span class="form-label">Konfirmasi Password</span>
                                                <input placeholder="Konfirmasi Password " id="password-confirm"
                                                    type="password" class="form-control" name="password_confirmation"
                                                    required autocomplete="new-password">
                                            </div>
                                            <div class="mt-3">
                                                <span class="form-label">Nomor Hp</span>
                                                <input placeholder="Nomor Telepon" id="telp" type="telp"
                                                    class="form-control @error('telp') is-invalid @enderror"
                                                    name="telp" required autocomplete="telp"
                                                    value="{{ old('telp') }}">
                                            </div>
                                            <div class="d-flex justify-content-end mt-4">
                                                <input type="submit" class="btn btn-primary" value="Sign up" />
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7">
                        <div class="booking-cta">
                            <h1 class="text">Welcome! :)</h1>
                            <p class="text"> Temukan Paket Wisata Di sini, Kami Membantu
                                Wisata Anda, Di mana pun
                                dan Kapan pun.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
