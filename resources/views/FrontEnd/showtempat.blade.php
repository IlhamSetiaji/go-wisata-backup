<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/GoWisata.png') }}" type="image/png">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('vendor/depan/assets/css/swiper-bundle.min.css') }}">

    <!--=============== CSS ===============-->
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('vendor/depan/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <title>GoWisata.</title>
</head>

<body>

    <header class="header" id="header" onload="myFunction()">
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
            @if ($tempat2->image2 == null)
                <img src=" {{ asset('vendor/depan/assets/img/213.jpg') }}" alt="" class="home__img">
            @else
                <img src="{{ asset('images') }}/{{ $tempat2->image2 }}" alt="" class="home__img">
            @endif
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Temukan liburan Anda di</span>
                    <h1 class="home__data-title">{{ $tempat2->name }}<br> <b>{{ $tempat2->alamat }}</b></h1>
                    @if (count($wahana) > 0)
                        <a href="#wahana" class="button">Wahana</a>
                    @endif
                    @if (count($camp1) > 0)
                        <a href="#camp" class="button">Camping</a>
                    @endif
                    @if (count($ez) > 0)
                        <a href="#place" class="button">Disekitar</a>
                    @endif
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


        {{-- DESKRIPSI --}}


        @if ($tempat->deskripsi == '')
        @else
            <section class="about_section">
                <h2 class="section__title">Tentang {{ $tempat->name }}</h2>

                <div class="container">
                    <p class="about__container">{{ $tempat->deskripsi }}</p>
                </div>
            </section>
        @endif


        {{-- SEJARAH --}}
        @if ($tempat->sejarah == '')
        @else
            <section class="about_section">
                <h2 class="section__title">Sejarah {{ $tempat->name }}</h2>

                <div class="container">
                    <p class="about__container">{{ $tempat->sejarah }}</p>
                </div>
            </section>
        @endif





        {{-- akses --}}

        @if ($tempat->akses == '')
        @else
            <section class="about_section">
                <h2 class="section__title">Akses ke {{ $tempat->name }}</h2>

                <div class="container">
                    <p class="about__container">{{ $tempat->akses }}</p>
                </div>
            </section>
        @endif


        {{-- atraksi --}}

        @if ($tempat->atraksi == '')
        @else
            <section class="about_section">
                <h2 class="section__title">Atraksi di {{ $tempat->name }}</h2>

                <div class="container">
                    <p class="about__container">{{ $tempat->atraksi }}</p>
                </div>
            </section>
        @endif


        <!--==================== EXPERIENCE ====================-->
        <section class="experience section">
            {{-- <h2 class="section__title"> {{ $tempat->name }}  <br> </h2> --}}
            @if ($tempat2->htm == 0 || $tempat2->htm == null)
            @else
                <form action="{{ url('/cart/tambah/tiket/' . $tempat2->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tempat_id" value="{{ $tempat2->id }}">
                    <input type="hidden" name="kategori" value="tiket">
                    <h2 class="section__title">Beli berapa tiket ?</h2>

                    <h2 class="section__title"><input name="jml_orang" type="number" class="form-control"
                            id="jml_orang" placeholder="Jumlah Orang" min="1" required> Rp.
                        {{ number_format($tempat2->htm) }}/tiket</h2>

                    <h5 class="section__title">
                        <button class="button" type="submit">
                            {{-- Reserve Place --}}
                            Pesan Tiket
                        </button>
                    </h5>
                </form>
            @endif



            @if (count($camp1) > 0)
                <!--==================== ABOUT ====================-->
                <section class="about section" id="camp">
                    <div class="about__container container grid">
                        <div class="about__data">
                            <h2 class="section__title about__title"> Di {{ $tempat->name }}<br> Ada Camping Ground lho
                            </h2>
                            <p class="about__description"> Langsung saja tekan tombol mau camping
                            </p>
                            <a href="{{ url('/mau/camping/' . $tempat2->id) }}" class="button">Mau Camping !</a>
                        </div>

                        <div class="about__img">

                            <div class="about__img-overlay">
                                <img src="{{ asset('vendor/depan/assets/img/camping.jpg') }}" alt=""
                                    class="about__img-two">
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if (count($wahana) > 0)
                <!--==================== WAHANA ====================-->

                @foreach ($wahana as $wahana)
                    <section class="about section" id="camp">
                        <div class="about__container container grid">
                            <div class="about__data">
                                <h2 class="section__title about__title"> Di {{ $tempat->name }} ada
                                    {{ $wahana->name }}<br>
                                </h2>
                                <p class="about__description"> Langsung saja tekan tombol daftar sekarang!
                                </p>
                                <a href="{{ url('/mau/camping/' . $wahana->id) }}" class="button">Daftar sekarang
                                    !</a>
                            </div>

                            <div class="about__img">

                                <div class="about__img-overlay">
                                    <img src="{{ asset('images') }}/{{ $wahana->image }}" alt=""
                                        class="about__img-two">
                                </div>
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif




            <!--==================== DISCOVER ====================-->
            {{-- @if (count($wahana) > 0)
            <section class="discover section" id="wahana">
                <h2 class="section__title">Wahana <br> Yang Tersedia</h2>

                <div class="discover__container container swiper-container">
                    <div class="swiper-wrapper"> --}}

            {{-- @foreach ($wahana as $key => $whn) --}}
            <!--==================== DISCOVER 1 ====================-->
            {{-- @if ($tempat2->id != $whn->tempat_id) --}}

            {{-- <div class="discover__card swiper-slide">
                                <img src="{{ asset('images') }}/{{ $whn->image }}" alt=""
                                    class="discover__img">
                                <div class="discover__data">

                                    <h2 class="discover__title">{{ $whn->name }}</h2>

                                    <span class="discover__description">
                                        @if ($whn->harga == '0' || $whn->harga == null)
                                            Free
                                        @else
                                            <a disabled class="button"> Rp.{{ number_format($whn->harga) }} </a>
                                        @endif

                                    </span>
                                </div>
                                @if ($whn->harga == '0' || $whn->harga == null)
                                @else
                                    <form action="{{ url('/cart/tambah/' . $whn->kode_wahana) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="tempat_id" value="{{ $tempat2->id }}">
                                        <input type="hidden" name="durasi" class="form-control" id="durasi"
                                            value="1" required>
                                        <input type="hidden" name="kategori" value="wahana">
                                        <input name="jumlah" class="form-control" type="number" id="jumlah Pesan"
                                            placeholder="Jumlah" required>
                                        <button class="button button--flex place__button">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                @endif

                            </div> --}}

            {{-- @endforeach



                    </div>
                </div>
            </section>
        @else
        @endif --}}


            <?php
            
            $ez2 = App\Models\Tempat::where('induk_id', $tempat->induk_id)
                ->where(['status' => 1, 'kategori' => 'wisata'])
                ->get();
            $penginapan = App\Models\Tempat::where([
                'induk_id' => $tempat->induk_id,
                'kategori' => 'penginapan',
                'status' => 1,
            ])->get();
            $kuliner = App\Models\Tempat::where([
                'induk_id' => $tempat->induk_id,
                'kategori' => 'kuliner',
                'status' => 1,
            ])->get();
            $event = App\Models\Tempat::where([
                'induk_id' => $tempat->induk_id,
                'kategori' => 'event & sewa tempat',
                'status' => 1,
            ])->get();
            
            ?>
            {{-- {{ dd($penginapan) }} --}}
            @if (count($ez2) > 0)
                <section class="place section" id="place">
                    <h2 class="section__title">Tempat Wisata Disekitar {{ $tempat->name }}</h2>
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
                                <a href="/{{ $tempat2->kategori }}/{{ $tempat2->slug }}">
                                    <button class="button button--flex place__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>

                            </div>
                        @endforeach

                    </div>
                </section>
            @endif

            @if (count($event) > 0)
                <section class="place section" id="place">
                    <h2 class="section__title">Event Disekitar {{ $tempat->name }}</h2>
                    <div class="place__container container grid">

                        @foreach ($event as $key => $tempat2)
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
                                <a href="/{{ $tempat2->kategori }}/{{ $tempat2->slug }}">
                                    <button class="button button--flex place__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>

                            </div>
                        @endforeach

                    </div>
                </section>
            @endif

            @if (count($penginapan) > 0)
                <section class="place section" id="place">
                    <h2 class="section__title">Penginapan Disekitar {{ $tempat->name }}</h2>
                    <div class="place__container container grid">

                        @foreach ($penginapan as $key => $tempat2)
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
                                <a href="/{{ $tempat2->kategori }}/{{ $tempat2->slug }}">
                                    <button class="button button--flex place__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>

                            </div>
                        @endforeach

                    </div>
                </section>
            @endif
            @if (count($kuliner) > 0)
                <section class="place section" id="place">
                    <h2 class="section__title">Kuliner Disekitar {{ $tempat->name }}</h2>
                    <div class="place__container container grid">

                        @foreach ($kuliner as $key => $tempat2)
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
                                <a href="/{{ $tempat2->kategori }}/{{ $tempat2->slug }}">
                                    <button class="button button--flex place__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>

                            </div>
                        @endforeach

                    </div>
                </section>
            @endif



        </section>
        {{-- {{ dd($tempat2) }} --}}


        @if (!$tempat2->video == '')
            <!--==================== VIDEO ====================-->
            <section class="video section">
                <h2 class="section__title">Video Tour</h2>

                <div class="video__container container">
                    <p class="video__description">Cari tahu lebih lanjut dengan video kami ini dan cari
                        tempat yang menyenangkan untuk Anda dan keluarga.
                    </p>

                    <div class="video__content">
                        <video id="video-file" controls autoplay muted>

                            {{-- <source src="https://www.youtube.com/watch?v=zJNIFyVAmQw" type="video/mp4"> --}}
                            <source src="{{ asset('videos') . '/' . $tempat2->video }}" type="video/mp4">
                            {{-- <source src="{{ asset('./vendor/depan/assets/video/video.mp4') }}" type="video/mp4"> --}}
                        </video>

                        <button class="button button--flex video__button" id="video-button">
                            <i class="ri-play-line video__button-icon" id="video-icon"></i>
                        </button>
                    </div>
                </div>
            </section>
        @else
            <section class="video section">
                {{-- <h2 class="section__title">Video Tour</h2> --}}

                <div class="video__container container">
                    {{-- <p class="video__description">Cari tahu lebih lanjut dengan video kami ini dan cari
                        tempat yang menyenangkan untuk Anda dan keluarga.
                    </p> --}}

                    <div class="video__content">
                        <video id="video-file" controls autoplay muted>
                            {{-- <source src="{{ asset('./vendor/depan/assets/video/video.mp4') }}" type="video/mp4"> --}}
                        </video>

                        <button class="button button--flex video__button" id="video-button" type="hidden">

                        </button>
                    </div>
                </div>
            </section>
        @endif



        <!--==================== KULINER ====================-->

        <!--==================== SPONSORS ====================-->
        <div class="experience__container container grid">
            <div class="experience__content grid">
                <div class="experience__data">
                    <h2 class="experience__number">
                        {{ App\Models\Wahana::where('tempat_id', $tempat2->id)->where('harga', '!=', 0)->count() }}+
                    </h2>
                    <span class="experience__description">Wahana <br> Yang Seruu</span>
                </div>
                <div class="experience__data">
                    <h2 class="experience__number">
                        {{ App\Models\Wahana::where('tempat_id', $tempat2->id)->where('harga', 0)->count() }}+</h2>
                    <span class="experience__description">Wahana <br> Umum /Free</span>
                </div>

                <div class="experience__data">
                    <h2 class="experience__number">
                        {{ App\Models\Detail_transaksi::where('tempat_id', $tempat2->id)->count() }}+</h2>
                    <span class="experience__description">Pesanan <br> Selesai</span>
                </div>


            </div>


        </div>
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
                            <a href="mailto:emailwatugambir@gmail.com"
                                class="footer__link">emailwatugambir@gmail.com</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Indonesia</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer__rights">
                <p class="footer__copy">&#169; 2022 GoWisata. All rigths reserved.</p>
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
    <script src="{{ asset('vendor/depan/assets/js/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('vendor/depan/assets/js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('vendor/depan/assets/js/main.js') }}"></script>
</body>

</html>
<script>
    function myFunction() {
        var x = document.getElementById("video-file").autoplay;
        return x;
    }
</script>
