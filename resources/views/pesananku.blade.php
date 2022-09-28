<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- META DATA -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
    <!-- TITLE OF SITE -->

    <title>GoWisata.</title>


    <!-- favicon img -->
    <link rel="shortcut icon" type="image/icon" href="{{ asset('assets/images/favicon/GoWisata.png') }}" />
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>
    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/font-awesome.min.css') }}" />

    <!--animate.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/animate.css') }}" />

    <!--hover.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/hover-min.css') }}">

    <!--datepicker.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/datepicker.css') }}">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/owl.theme.default.min.css') }}" />

    <!-- range css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/jquery-ui.min.css') }}" />

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/bootstrap.min.css') }}" />

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/bootsnav.css') }}" />

    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/style.css') }}" />

    <!--responsive.css-->
    <link rel="stylesheet" href="{{ asset('./vendor/tour/assets/css/responsive.css') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
    <!--[if lte IE 9]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
   your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!-- main-menu Start -->
    <header class="top-area">
        <div class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <i class="fa fa-map-marker"></i> GoWisata.<span></span>
                            </a>
                        </div><!-- /.logo-->
                    </div><!-- /.col-->
                    <div class="col-sm-10">
                        <div class="main-menu">

                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                    <i class="fa fa-bars"></i>
                                </button><!-- / button-->
                            </div><!-- /.navbar-header-->
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/') }}"> Home</a>
                                    </li>
                                    {{-- <li class="smooth-menu"><a href="">Destination</a></li> --}}
                                    {{-- <li class="smooth-menu"><a href="#pack">Tempat Wisata </a></li> --}}
                                    {{-- <li class="smooth-menu"><a href="#spo">Special Offers</a></li>
										<li class="smooth-menu"><a href="#blog">blog</a></li>
										<li class="smooth-menu"><a href="#subs">subscription</a></li> --}}

                                    @guest
                                        <li class="nav-item">
                                            <a class="book-btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('pesananku') }}">{{ __('Pesananku') }}</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>


                                            <div class="smooth-menu" aria-labelledby="navbarDropdown">

                                                <form id="my-antrian" action="" method="GET" class="d-none">

                                                </form>

                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                &nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i>&nbsp;&nbsp;&nbsp;
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>

                                        </li>
                                    @endguest
                                    {{-- <button class="book-btn">login
											</button> --}}
                                    </li>
                                    <!--/.project-btn-->
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.main-menu-->
                    </div><!-- /.col-->
                </div><!-- /.row -->
                <div class="home-border"></div><!-- /.home-border-->
            </div><!-- /.container-->
        </div><!-- /.header-area -->

    </header><!-- /.top-area-->
    <!-- main-menu End -->




    <!--service start-->
    <section id="service" class="service">
        <div class="container">

            <div class="service-counter text-center">

                <div class="col-md-4 col-sm-4">
                    <div class="single-service-box">
                        <div class="service-img">
                            <img src="{{ asset('./vendor/tour/assets/images/service/s1.png') }}" alt="service-icon" />
                            <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons"
                                    title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/"
                                    title="Flaticon">www.flaticon.com</a></div>
                        </div>
                        <!--/.service-img-->
                        <div class="service-content">
                            <h2>
                                <a href="#">
                                    Pakai Masker

                                </a>
                            </h2>
                            <p> Jangan lupa memakai masker selalu yaa</p>
                        </div>
                        <!--/.service-content-->
                    </div>
                    <!--/.single-service-box-->
                </div>
                <!--/.col-->

                <div class="col-md-4 col-sm-4">
                    <div class="single-service-box">
                        <div class="service-img">
                            <img src="{{ asset('./vendor/tour/assets/images/service/s2.png') }}"
                                alt="service-icon" />
                            <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a
                                    href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>

                        </div>
                        <!--/.service-img-->
                        <div class="service-content">
                            <h2>
                                <a href="#">
                                    Jaga Jarak
                                </a>
                            </h2>
                            <p> Jaga jarak dengan orang lain sebesar 1,5 meter</p>
                        </div>
                        <!--/.service-content-->
                    </div>
                    <!--/.single-service-box-->
                </div>
                <!--/.col-->

                <div class="col-md-4 col-sm-4">
                    <div class="single-service-box">
                        <div class="statistics-img">
                            <img src="{{ asset('./vendor/tour/assets/images/service/s3.png') }}"
                                alt="service-icon" />
                            <div>Icons made by <a href="https://www.flaticon.com/authors/srip" title="srip">srip</a>
                                from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
                        </div>
                        <!--/.service-img-->
                        <div class="service-content">

                            <h2>
                                <a href="#">
                                    Cuci Tangan
                                </a>
                            </h2>
                            <p>Cuci tangan dengan sabun dan air mengalir atau memakai hand sanitizer </p>
                        </div>
                        <!--/.service-content-->
                    </div>
                    <!--/.single-service-box-->
                </div>
                <!--/.col-->

            </div>
            <!--/.statistics-counter-->
        </div>
        <!--/.container-->

    </section>
    <!--/.service-->
    <!--service end-->
    <hr>



    <section id="spo" class="packages">
        <div class="container">


            <div class="gallary-header text-center ">
                <h2>
                    Pesananku
                </h2>
                <p>
                    <li class="breadcrumb breadcrumb-right text-center "> <a href="{{ url('/pesanan/all') }}"
                            class="btn btn-outline-primary "> Semua Pesanananku</a></li>
                </p>
            </div>
            <!--/.gallery-header-->

            <div class="packages-content">
                <div class="row">

                    @if (count($tiket) > 0)
                        @foreach ($tiket as $key => $tiket)
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">

                                    <div class="single-package-item-txt">
                                        <h3>{{ $tiket->kode }}</h3>
                                        <span class="pull-right"> Rp.{{ number_format($tiket->harga) }}</span>

                                        <div class="packages-para">
                                            <p>
                                                <i class="fa fa-angle-right"></i> <a
                                                    href="{{ url('/pesanan/detail/' . $tiket->kode) }}"> Detail
                                                    Pesanan </a>
                                            </p>
                                        </div>
                                        <!--/.packages-para-->
                                        @if ($tiket->status == 0)
                                            <a href="{{ url('bayar', [$tiket->id]) }}"><button
                                                    class="btn btn-primary"> Pilih Pembayaran</button></a>
                                        @else
                                            @foreach (App\Models\Pay::where('kodeku', $tiket->kode)->get() as $status)
                                                @if ($status->transaction_status == 'settlement')
                                                    <button class="btn btn-outline-success">Berhasil Dibayar</button>
                                                @elseif ($status->transaction_status == 'pending')
                                                    <a href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                            class="btn btn-warning">Menunggu Dibayar</button>
                                                    @elseif ($status->transaction_status == null)

                                                    @elseif ($status->transaction_status == 'expire')
                                                        <button class="btn btn-danger"> &nbsp; &nbsp; &nbsp; &nbsp;
                                                            &nbsp;Expire &nbsp; &nbsp; &nbsp; &nbsp;</button>
                                                    @elseif ($status->transaction_status == 'cancel')
                                                        <button class="btn btn-danger"> &nbsp; &nbsp;
                                                            &nbsp;Dibatalkan&nbsp; &nbsp; &nbsp; </button>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if ($tiket->status == 0)
                                        @else
                                            <a href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                    class="btn  btn-outline-info"><i
                                                        class="fas fa-search"></i></button>
                                        @endif
                                    </div>
                                    <!--/.single-package-item-txt-->
                                </div>
                                <!--/.single-package-item-->
                            </div>
                            <!--/.col-->
                        @endforeach
                    @else
                    @endif


                </div>
                <!--/.row-->
            </div>
            <!--/.packages-content-->
            <li class="breadcrumb breadcrumb-right text-center "> <a href="{{ url('/pesanan/all') }}"
                    class="btn btn-outline-primary "> Semua Pesanananku</a></li>
        </div>
        <!--/.container-->

    </section>
    <!--/.packages-->

    <!-- footer-copyright start -->
    <footer class="footer-copyright">
        <div class="container">
            <div class="footer-content">
                <div class="row">

                    <div class="col-sm-3">
                        <div class="single-footer-item">
                            <div class="footer-logo">
                                <a href="index.html">
                                    <i class="fa fa-map-marker"></i>
                                    Lun<span>go.</span>
                                </a>
                                <p>

                                </p>
                            </div>
                        </div>
                        <!--/.single-footer-item-->
                    </div>
                    <!--/.col-->

                    <div class="col-sm-3">
                        {{-- <div class="single-footer-item">

								<div class="single-footer-txt">

									<p><a href="#"></a></p>
									<p><a href="#"></a></p>
                                    <p><a href="#">home</a></p>
									<p><a href="{{ url('/#pack') }}">destination</a></p>
									<p><a href="#"></a></p>
									<p><a href="#"></a></p>
								</div><!--/.single-footer-txt-->
							</div><!--/.single-footer-item--> --}}

                    </div>
                    <!--/.col-->

                    <div class="col-sm-3">
                        <div class="single-footer-item">
                            <h2>Tujuan Wisata</h2>
                            <div class="single-footer-txt">
                                <p><a href="{{ url('/app/Watu Gambir') }}">Watu Gambir</a></p>

                            </div>
                            <!--/.single-footer-txt-->
                        </div>
                        <!--/.single-footer-item-->
                    </div>
                    <!--/.col-->

                    <div class="col-sm-3">
                        <div class="single-footer-item text-center">
                            <h2 class="text-left">kontak</h2>
                            <div class="single-footer-txt text-left">
                                <p>+62 8588 2218 939</p>
                                <p class="foot-email"><a href="#">AdminLungo@gmail.com</a></p>
                                <p>Indonesia</p>

                            </div>
                            <!--/.single-footer-txt-->
                        </div>
                        <!--/.single-footer-item-->
                    </div>
                    <!--/.col-->

                </div>
                <!--/.row-->

            </div>
            <!--/.footer-content-->
            <hr>
            <div class="foot-icons ">
                <ul class="footer-social-links list-inline list-unstyled">
                    <li><a href="#" target="_blank" class="foot-icon-bg-1"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#" target="_blank" class="foot-icon-bg-2"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="https://www.instagram.com/alifudinniko/" target="_blank" class="foot-icon-bg-3"><i
                                class="fa fa-instagram"></i></a></li>
                </ul>
                {{-- <p>&copy; 2017 <a href="https://www.themesine.com">ThemeSINE</a>. All Right Reserved</p> --}}
                <p>&copy; 2021 <a href="https://www.themesine.com">Lungo</a>. All Right Reserved</p>

            </div>
            <!--/.foot-icons-->
            <div id="scroll-Top">
                <i class="fa fa-angle-double-up return-to-top" id="scroll-top" data-toggle="tooltip"
                    data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
            </div>
            <!--/.scroll-Top-->
        </div><!-- /.container-->

    </footer><!-- /.footer-copyright-->
    <!-- footer-copyright end -->



    {{-- <script src="{{ asset('./vendor/depan/js/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('./vendor/depan/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/tour/assets/js/jquery.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


    <!--bootstrap.min.js-->
    <script src="{{ asset('./vendor/tour/assets/js/bootstrap.min.js') }}"></script>

    <!-- bootsnav js -->
    <script src="{{ asset('./vendor/tour/assets/js/bootsnav.js') }}"></script>

    <!-- jquery.filterizr.min.js -->
    <script src="{{ asset('./vendor/tour/assets/js/jquery.filterizr.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!--jquery-ui.min.js-->
    <script src="{{ asset('./vendor/tour/assets/js/jquery-ui.min.js') }}"></script>

    <!-- counter js -->
    <script src="{{ asset('./vendor/tour/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('./vendor/tour/assets/js/waypoints.min.js') }}"></script>

    <!--owl.carousel.js-->
    <script src="{{ asset('./vendor/tour/assets/js/owl.carousel.min.js') }}"></script>

    <!-- jquery.sticky.js -->
    <script src="{{ asset('./vendor/tour/assets/js/jquery.sticky.js') }}"></script>

    <!--datepicker.js-->
    <script src="{{ asset('./vendor/tour/assets/js/datepicker.js') }}"></script>

    <!--Custom JS-->
    <script src="{{ asset('./vendor/tour/assets/js/custom.js') }}"></script>


</body>

</html>
