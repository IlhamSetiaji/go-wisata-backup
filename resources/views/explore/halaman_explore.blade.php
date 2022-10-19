@extends('FrontEnd.main')
@section('content')
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="{{ asset('images/setting') }}/{{ $setting->home1 }}" alt="" class="home__img">
            <!--<a href='https://www.freepik.com/vectors/background'>Background vector created by freepik - www.freepik.com</a>-->

            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Temukan liburan Anda</span>
                    <h1 class="home__data-title">Ayo Liburan<br> <b>Bersama Kami</b></h1>
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
        <div class="container">
            &nbsp;
            <div class="row me-1">
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Desa Wisata</h5>
                            <p class="card-text" align="justify">Explore wisata memberikan beragam informasi penting paket
                                wisata liburan bersama keluarga, yang menarik untuk dikunjungi dengan harga terjangkau.
                            </p>
                            <a href="{{ url('explore_desa_wisata') }}" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Event</h5>
                            <p class="card-text" align="justify">Explore event memberikan beragam informasi penting tentang
                                kegiatan atau acara yang bisa diikuti bersama teman maupun keluarga.
                            </p>
                            <a href="/explore-event" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kuliner</h5>
                            <p class="card-text" align="justify">Explore kuliner memberikan referensi makanan dan minuman
                                yang bisa Anda coba bersama teman maupun keluarga.
                            </p>
                            <a href="/explore_kuliner" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penginapan (Hotel & Villa)</h5>
                            <p class="card-text" align="justify">Explore penginapan memberikan beragam informasi mengenai
                                hotel dan villa yang tersedia, jika Anda membutuhkan tempat yang nyaman untuk liburan.
                            </p>
                            <a href="/explore-penginapan" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Merchandise</h5>
                            <p class="card-text" align="justify">Explore merchandise memberikan beragam informasi produk
                                atau pernak-pernik khas daerah, untuk Anda yang tertarik membeli oleh-oleh.
                            </p>
                            <a href="#" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penyewaan Tempat</h5>
                            <p class="card-text" align="justify">Explore penyewaan tempat memberikan informasi tempat yang
                                bisa disewa untuk keperluan Wedding, Acara Keluarga, dan lain-lain.
                            </p>
                            <a href="/explore-penyewaan-tempat" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penginapan Watu Gambir</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.
                            </p>
                            <a href="#" class="button">Explore</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </main>
@endsection
