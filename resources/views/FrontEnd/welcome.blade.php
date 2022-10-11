@extends('FrontEnd.main')
@section('content')

    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home" id="home">
            @if ($setting->home1 == null)
                Gambar Belum Tersedia
            @else
                <img src="{{ asset('images/setting') }}/{{ $setting->home1 }}" alt="" class="home__img">
            @endif
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Temukan liburan Anda</span>
                    <h1 class="home__data-title">Ayo Liburan<br> <b>Bersama Kami</b></h1>
                    <a href="{{ url('/explore') }}" class="button">Explore</a>
                </div>
                <div class="home__social">
                    <a href="https://www.facebook.com/" target="_blank" class="home__social-link"><i
                            class="ri-facebook-box-fill"></i></a>
                    <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                        <i class="ri-instagram-fill"></i></a>
                    <a href="https://twitter.com/" target="_blank" class="home__social-link">
                        <i class="ri-twitter-fill"></i></a>
                </div>
                @php $kegi = App\Models\Event::where('status', 1)->count(); @endphp
                @if ($kegi > 0)
                    <div class="home__info">
                        <div>
                            <?php
                            $keg = App\Models\Event::where('status', 1)
                                ->orderby('id', 'DESC')
                                ->first();
                            ?>
                            <span class="home__info-title">Event yang seru </span>
                            <a href="{{ url('/explore-event') }}"
                                class="button button--flex button--link home__info-button">
                                More <i class="ri-arrow-right-line"></i></a>
                        </div>
                        <div class="home__info-overlay">
                            <img src="{{ asset('images') }}/{{ $keg->foto }}" alt="" class="home__info-img">
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!--==================== ABOUT ====================-->
        <section class="about section" id="about">
            <div class="about__container container grid">
                <div class="about__data">
                    <h2 class="section__title about__title">Apa itu<br> GoWisata.</h2>
                    <p class="about__description">Go-Wisata membantu Anda untuk dapat menemukan tempat wisata yang
                        paling
                        keren dan
                        menyenangkan
                        dengan harga terbaik , Cari tempat liburan anda sekarang!
                    </p>
                </div>

                <div class="about__img">
                    <div class="about__img-overlay">
                        @if ($setting->about1 == null)
                            Gambar Tidak Tersedia
                        @else
                            <img src="{{ asset('images/setting') }}/{{ $setting->about1 }}" alt=""
                                class="about__img-one">
                        @endif
                    </div>

                    <div class="about__img-overlay">
                        @if ($setting->about2 == null)
                            Gambar Tidak Tersedia
                        @else
                            <img src="{{ asset('images/setting') }}/{{ $setting->about2 }}" alt=""
                                class="about__img-two">
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--==================== DISCOVER ====================-->
        <section class="discover section" id="discover">
            <h2 class="section__title">Temukan Tempat Wisata <br> Di Desa Wisata Paling Menarik</h2>

            <div class="card-group mx-5">
                @if (count($tempat) > 0)
                    @foreach ($tempat as $key => $tempat)
                        <div class="card mx-3">
                            <!--==================== DISCOVER 1 ====================-->
                            @if ($tempat->image == null)
                                Gambar Tidak Tersedia
                            @else
                                <img src="{{ asset('images') }}/{{ $tempat->image }}" alt=""
                                    class="discover__img">
                            @endif
                            <div class="discover__data">
                                <h2 class="discover__title">{{ $tempat->name }}</h2>
                            </div>
                            {{-- {{ dd($tempat) }} --}}
                            <a href="{{ url('./' . $tempat->slug) }}">
                                <button class="button button--flex place__button">
                                    <i class="ri-arrow-right-line"></i>
                                </button>
                            </a>
                        </div>
                    @endforeach
                @else
                    <img src="{{ asset('images/setting') }}/{{ $setting->about1 }}" alt="" class="about__img-one">
                @endif
            </div>
        </section>


        {{-- <section class="budgeting mt-3">
            <h2 class="section__title">Sesuaikan Liburan Dengan Budget Anda</h2>
            <!-- Button trigger modal -->
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tekan disini
                </button>
            </div>

        </section> --}}


        @if (!$setting->video == null)
            <!--==================== VIDEO ====================-->
            <section class="video section">
                <h2 class="section__title">Video Tour</h2>

                <div class="video__container container">
                    <p class="video__description">Cari tahu lebih lanjut dengan video kami ini dan cari
                        tempat yang menyenangkan untuk Anda dan keluarga.
                    </p>

                    <div class="video__content">
                        <video id="video-file">
                            @if ($setting->video == null)
                                Video Tidak Tersedia
                            @else
                                <source src="{{ asset('videos') }}/{{ $setting->video }}" type="video/mp4">
                            @endif
                        </video>
                        <button class="button button--flex video__button" id="video-button">
                            <i class="ri-play-line video__button-icon" id="video-icon"></i>
                        </button>
                    </div>
                </div>
            </section>
        @else
            <section class="video section">
                <div class="video__container container">
                    <div class="video__content">
                        <video id="video-file">
                        </video>
                        <button class="button button--flex video__button" id="video-button" type="hidden">
                        </button>
                    </div>
                </div>
            </section>
        @endif
        </section>
    </main>

    <!-- Modal -->
    {{-- <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Perkiraan Biaya yang Diperlukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
