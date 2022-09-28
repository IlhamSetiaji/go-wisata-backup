<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/GoWisata.png') }}" type="image/png">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('./vendor/depan/assets/css/swiper-bundle.min.css') }}">

    <!--=============== CSS ===============-->
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('./vendor/depan/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <title>GoWisata.</title>
</head>

<body>

    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ url('/') }}" class="nav__logo">GoWisata.</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ url('/') }}" class="nav__link ">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="/explore" class="nav__link ">Explore</a>
                    </li>



                    @guest
                        <li class="nav__item">
                            <a href="{{ route('login') }}" class="nav__link">Login</a>
                        </li>
                    @else
                        @if (auth()->check() && auth()->user()->role->id != 5)
                            <li class="nav__item">
                                <a href="{{ route('dashboard') }}" class="nav__link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav__item">
                                <a href="{{ route('pesananku') }}" class="nav__link">Pesananku</a>
                            </li>
                            @if (!empty($kuliner))
                                <li class="nav__item">
                                    <a href="{{ route('cart.kuliner') }}" class="nav__link">Cart</a>
                                </li>
                            @endif
                        @endif
                        <li class="nav__item">
                            <a href="{{ url('/profile') }}" class="nav__link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav__link"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf

                            </form>

                        </li>
                    @endguest
                </ul>

                <div class="nav__dark">
                    <!-- Theme change button -->
                    <span class="change-theme-name">Dark mode</span>
                    <i class="ri-moon-line change-theme" id="theme-button"></i>
                </div>

                <i class="ri-close-line nav__close" id="nav-close"></i>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-function-line"></i>
            </div>
        </nav>
    </header>

    <main class="main">
        {!! Toastr::message() !!}
        <!--==================== HOME ====================-->
        <section class="home" id="home">
            @if ($tempat->image2 == null)
                <img src=" {{ asset('./vendor/depan/assets/img/213.jpg') }}" alt="" class="home__img">
            @else
                <img src="{{ asset('images') }}/{{ $tempat->image2 }}" alt="" class="home__img">
            @endif
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Temukan liburan Anda di</span>
                    <h1 class="home__data-title">{{ $tempat->name }}<br> <b>{{ $tempat->alamat }}</b></h1>
                    <a href="#place" class="button">Penginapan</a>
                    {{-- <a href="#kamar" class="button">Kamar</a> --}}
                    @isset($cekkamar)
                        <a href="#cek" class="button">Cek Hasil</a>
                    @endisset


                </div>

                <div class="home__social">
                    <a href="https://www.facebook.com/" target="_blank" class="home__social-link">
                        <i class="ri-facebook-box-fill"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="home__social-link">
                        <i class="ri-twitter-fill"></i>
                    </a>
                </div>


            </div>
        </section>


        @isset($penginapan)
            @if (count($penginapan) > 0)
                <section class="place section" id="place">
                    <h2 class="section__title">Hotel Disekitar</h2>
                    <div class="place__container container grid">
                        @foreach ($penginapan as $key => $tempat2)
                            <!--==================== PLACES CARD 1 ====================-->
                            <div class="place__card">
                                <img src="{{ asset('images') }}/{{ $tempat2->foto }}" style="width:200px;height:600px;"
                                    class="place__img">

                                <div class="place__content">
                                    <span class="place__rating">
                                        <i class="ri-star-line place__rating-icon"></i>
                                    </span>

                                    <div class="place__data">
                                        <h3 class="place__title">{{ $tempat2->nama }}</h3>

                                        <span class="place__price">{{ $tempat2->tempat->name }}</span>
                                    </div>
                                </div>
                                <a target="_blank" href="/explore-hotel/{{ $tempat2->id }}">
                                    <button class="button button--flex place__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>

                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endisset

        <!--==================== KULINER ====================-->
        <?php
        
        $ez2 = App\Models\Tempat::where('induk_id', $tempat->induk_id)
            ->where('status', 1)
            ->get();
        // dd($ez2);
        ?>
        @if (count($ez2) > 0)
            <section class="place section" id="place">
                <h2 class="section__title">Tempat Disekitar {{ $tempat->name }}</h2>
                <div class="place__container container grid">

                    @foreach ($ez2 as $key => $tempat2)
                        <!--==================== PLACES CARD 1 ====================-->
                        <div class="place__card">
                            <img src="{{ asset('images') }}/{{ $tempat2->image }}" alt=""
                                class="place__img">

                            <div class="place__content">
                                <span class="place__rating">
                                    <i class="ri-star-line place__rating-icon"></i>
                                    <!--<span class="place__rating-number">4,8</span>-->
                                </span>

                                <div class="place__data">
                                    <h3 class="place__title">{{ $tempat2->name }}</h3>

                                    <span class="place__price">{{ $tempat2->kategori }}</span>
                                </div>
                            </div>
                            <a href="{{ url('./' . $tempat2->kategori . '/' . $tempat2->slug) }}">
                                <button class="button button--flex place__button">
                                    <i class="ri-arrow-right-line"></i>
                                </button>
                            </a>

                        </div>
                    @endforeach

                </div>
            </section>
        @endif









        <!--==================== SPONSORS ====================-->
        <section class="sponsor section">
            <div class="sponsor__container container grid">
                @if (!$setting->sponsor1 == null)
                    <div class="sponsor__content">
                        <img src="{{ asset('images/setting') }}/{{ $setting->sponsor1 }}" alt=""
                            class="sponsor__img">
                    </div>
                @endif
                @if (!$setting->sponsor2 == null)
                    <div class="sponsor__content">
                        <img src="{{ asset('images/setting') }}/{{ $setting->sponsor2 }}" alt=""
                            class="sponsor__img">
                    </div>
                @endif
                @if (!$setting->sponsor3 == null)
                    <div class="sponsor__content">
                        <img src="{{ asset('images/setting') }}/{{ $setting->sponsor3 }}" alt=""
                            class="sponsor__img">
                    </div>
                @endif
                @if (!$setting->sponsor4 == null)
                    <div class="sponsor__content">
                        <img src="{{ asset('images/setting') }}/{{ $setting->sponsor4 }}" alt=""
                            class="sponsor__img">
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content grid">
                <div class="footer__data">
                    <h3 class="footer__title">GoWisata.</h3>
                    <p class="footer__description">Kami Membantu <br> wisata anda,
                        dimanapun <br> dan kapanpun.
                    </p>
                    <div>
                        <a href="https://www.facebook.com/" target="_blank" class="footer__social">
                            <i class="ri-facebook-box-fill"></i>
                        </a>
                        <a href="https://twitter.com/" target="_blank" class="footer__social">
                            <i class="ri-twitter-fill"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" class="footer__social">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <a href="https://www.youtube.com/" target="_blank" class="footer__social">
                            <i class="ri-youtube-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Kontak</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="" class="footer__link">+6285882218939</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">alifudinniko@student.uns.ac.id</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Indonesia</a>
                        </li>
                    </ul>
                </div>




            </div>

            <div class="footer__rights">
                <p class="footer__copy">&#169; 2021 GoWisata. All rigths reserved.</p>
                <div class="footer__terms">
                    <a href="#" class="footer__terms-link">Terms & Agreements</a>
                    <a href="#" class="footer__terms-link">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line scrollup__icon"></i>
    </a>

    <!--=============== SCROLL REVEAL===============-->
    <script src="{{ asset('./vendor/depan/assets/js/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('./vendor/depan/assets/js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('./vendor/depan/assets/js/main.js') }}"></script>
</body>

</html>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("min", today);
    document.getElementById("datefield2").setAttribute("min", today);
</script>
