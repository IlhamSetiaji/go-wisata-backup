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

    <title>GoWisata.</title>
</head>

<body onload="myFunction()">

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
                    <a href="#makan" class="button">Makanan</a>
                    <a href="#minum" class="button">Minuman</a>
                    <a href="#snack" class="button">Snack</a>

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






        <?php
        
        $ez2 = App\Models\Tempat::where('induk_id', $tempat->induk_id)
            ->where('status', 1)
            ->get();
        // dd($ez2);
        ?>

        <!--==================== Makanan ====================-->
        <section class="makan section" id="makan">
            <h2 class="section__title">Makanan <br> Yang Tersedia</h2>

            <div class="makan__container container grid">
                @if (count($makanan) > 0)
                    @foreach ($makanan as $key => $whn)
                        <!--==================== KULINER 1 ====================-->
                        <div class="makan__card">
                            <img src="{{ asset('images') }}/{{ $whn->image }}" alt="Responsive image"
                                class="img-thumbnail">
                            <div class="makan__data">

                                <h3 class="makan__title">{{ $whn->name }}</h3>

                                <span class="makan__description">
                                    @if ($whn->harga == '0' || $whn->harga == null)
                                        Free
                                    @else
                                        <a disabled class="button"> Rp.{{ number_format($whn->harga) }} </a>
                                    @endif

                                </span>
                            </div>

                            @if ($whn->harga == '0' || $whn->harga == null)
                            @else
                                <form action="{{ url('/cart/tambah/kuliner/' . $whn->kode_kuliner) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode_produk" value="{{ $whn->kode_kuliner }}">
                                    <input type="hidden" name="tempat_id" value="{{ $tempat->id }}">
                                    <input name="jumlah" class="form-control" type="number" id="jumlah"
                                        placeholder="Jumlah" min="0" required>
                                    <input type="hidden" name="kategori" value="kuliner">
                                    <button class="button button--flex makan__button">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            @endif

                        </div>
                    @endforeach
                @else
                    Sedang Liburan
                @endif


            </div>
        </section>

        <!--==================== Minuman ====================-->
        <section class="makan section" id="minum">
            <h2 class="section__title">Minuman <br> Yang Tersedia</h2>

            <div class="makan__container container grid">
                @if (count($minuman) > 0)
                    @foreach ($minuman as $key => $whn)
                        <!--==================== KULINER 1 ====================-->
                        <div class="makan__card">
                            <img src="{{ asset('images') }}/{{ $whn->image }}" alt="Responsive image"
                                class="img-thumbnail">
                            <div class="makan__data">

                                <h2 class="makan__title">{{ $whn->name }}</h2>

                                <span class="makan__description">
                                    @if ($whn->harga == '0' || $whn->harga == null)
                                        Free
                                    @else
                                        <a disabled class="button"> Rp.{{ number_format($whn->harga) }} </a>
                                    @endif

                                </span>
                            </div>
                            @if ($whn->harga == '0' || $whn->harga == null)
                            @else
                                <form action="{{ url('/cart/tambah/kuliner/' . $whn->kode_kuliner) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode_produk" value="{{ $whn->kode_kuliner }}">
                                    <input type="hidden" name="tempat_id" value="{{ $tempat->id }}">
                                    <input name="jumlah" class="form-control" type="number" id="jumlah"
                                        placeholder="Jumlah" min="0" required>
                                    <input type="hidden" name="kategori" value="kuliner">
                                    <button class="button button--flex makan__button">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            @endif

                        </div>
                    @endforeach
                @else
                    Sedang Liburan
                @endif

            </div>
        </section>

        <!--==================== Snack ====================-->
        <section class="makan section" id="snack">
            <h2 class="section__title">Makanan Ringan <br> Yang Tersedia</h2>

            <div class="makan__container container grid">
                @if (count($snack) > 0)
                    @foreach ($snack as $key => $whn)
                        <!--==================== KULINER 1 ====================-->
                        <div class="makan__card">
                            <img src="{{ asset('images') }}/{{ $whn->image }}" alt="Responsive image"
                                class="img-thumbnail">
                            <div class="makan__data">

                                <h2 class="makan__title">{{ $whn->name }}</h2>

                                <span class="makan__description">
                                    @if ($whn->harga == '0' || $whn->harga == null)
                                        Free
                                    @else
                                        <a disabled class="button"> Rp.{{ number_format($whn->harga) }} </a>
                                    @endif

                                </span>
                            </div>
                            @if ($whn->harga == '0' || $whn->harga == null)
                            @else
                                <form action="{{ url('/cart/tambah/kuliner/' . $whn->kode_kuliner) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode_produk" value="{{ $whn->kode_kuliner }}">
                                    <input type="hidden" name="tempat_id" value="{{ $tempat->id }}">
                                    <input name="jumlah" class="form-control" type="number" id="jumlah"
                                        placeholder="Jumlah" min="0" required>
                                    <input type="hidden" name="kategori" value="kuliner">
                                    <button class="button button--flex makan__button">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            @endif

                        </div>
                    @endforeach
                @else
                    Sedang Liburan
                @endif

            </div>
        </section>

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



        <!--==================== VIDEO ====================-->
        <section class="video section">
            {{-- <h2 class="section__title">Video Tour</h2> --}}

            <div class="video__container container">
                {{-- <p class="video__description">Cari tahu lebih lanjut dengan video kami ini dan cari
                        tempat yang menyenangkan untuk Anda dan keluarga.
                    </p> --}}

                <div class="video__content">
                    <video id="video-file" controls autoplay muted>
                        <source src="{{ asset('./vendor/depan/assets/video/video.mp4') }}" type="video/mp4">
                    </video>

                    <button class="button button--flex video__button" id="video-button" type="hidden">

                    </button>
                </div>
            </div>
        </section>

        <!--==================== KULINER ====================-->



        <div class="experience__container container grid">
            <div class="experience__content grid">
                <div class="experience__data">
                    <h2 class="experience__number">
                        {{ App\Models\Kuliner::where('tempat_id', $tempat->id)->where('harga', '!=', 0)->where('status', 1)->where('kategori', 'makan')->count() }}+
                    </h2>
                    <span class="experience__description">Makanan <br> Yang Sedap</span>
                </div>
                <div class="experience__data">
                    <h2 class="experience__number">
                        {{ App\Models\Kuliner::where('tempat_id', $tempat->id)->where('harga', '!=', 0)->where('status', 1)->where('kategori', 'minum')->count() }}+
                    </h2>
                    <span class="experience__description">Minuman<br> Yang Menyejukan</span>
                </div>

                <div class="experience__data">
                    <h2 class="experience__number">
                        {{ App\Models\Kuliner::where('tempat_id', $tempat->id)->where('harga', '!=', 0)->where('status', 1)->where('kategori', 'snack')->count() }}+
                    </h2>
                    <span class="experience__description">Snack <br> Yang Lezat</span>
                </div>


            </div>


        </div>






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
<script>
    function myFunction() {
        var x = document.getElementById("video-file").autoplay;
        return x;
    }
</script>

</html>
