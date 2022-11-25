@extends('FrontEnd.main')
@section('content')
    <main class="main">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}"> --}}
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-3.3.1.slim.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>


        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="{{ asset('images/setting') }}/{{ $setting->home1 }}" alt="" class="home__img">

            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__data-title">Banyak Tempat Menarik<br> <b>Bersama Kami</b></h1>
                    <form method="get" action="/explore-penginapan/search"> @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Check In" disabled>
                            <input type="date" name="checkin" id="datefield"
                                class="form-control checkin-date @error('checkin') is-invalid @enderror" required>
                            <input type="text" class="form-control" placeholder="Check Out" disabled>
                            <input type="date" name="checkout" id="datefield2"
                                class="form-control checkout-date @error('checkout') is-invalid @enderror" required>
                            {{-- <select class="form-select list-tempat" name="villa_id">
                            </select> --}}
                            {{-- <input type="number" name="jml_orang" class="form-control me-1" placeholder="jumlah orang"> --}}
                            <button class="button" type="submit">Search Villa</button>
                        </div>
                    </form>
                    <a href="/explore" class="button">Explore</a>
                    @isset($villa)
                        <a href="#cek" class="button">Cek Hasil</a>
                    @endisset
                </div>

            </div>
        </section>
        <div class="container">
            {!! Toastr::message() !!}

            &nbsp;
            <section class="row">
                @isset($villa)
                    <h2 class="section__title"> Tersedia {{ count($villa) }} Tempat <br> Di Tanggal
                        @isset($checkin)
                            {{ $checkin }}
                            @endisset sampai @isset($checkout)
                            {{ $checkout }}
                        @endisset </h2>
                    <section class="about section" id="cek">
                        @foreach ($villa as $key => $cekkamar)
                            <div class="about__container container grid">
                                <div class="about__data">
                                    <a href="/explore-penginapan-detail/{{ $cekkamar->id }}">
                                        <h2 class="section__title about__title"> {{ $cekkamar->nama }}
                                        </h2>
                                    </a>
                                    @php
                                        $rating = App\Models\reviewVilla::where('villa_id', $cekkamar->id)
                                            ->whereNotNull('rating')
                                            ->avg('rating');
                                    @endphp
                                    @if (isset($rating))
                                        <i class="fas fa-star .ik-star"> Rating {{ round($rating, 1) }} / 5</i>
                                    @else
                                        <i class="fas fa-star .ik-star"> Belum ada rating</i>
                                    @endif
                                    {{-- <i class="fas fa-star .ik-star"></i> --}}
                                    </br>
                                    <i class="fas fa-money-bill"> Rp.{{ number_format($cekkamar->harga) }} / malam</i>
                                    <p class="about__description" align="justify">
                                        {{ substr($cekkamar->deskripsi, 0, 200) }} <a
                                            href="/explore-penginapan-detail/{{ $cekkamar->id }}" target="_blank">read
                                            more...</a>
                                    </p>
                                </div>
                                <div class="about__img">
                                    <div class="about__img-overlay">
                                        <img src="{{ asset('images') }}/{{ $cekkamar->foto }}" alt=""
                                            style="width:300px;height:190px;" class="about__img-two">

                                        <a href="/explore-penginapan/booking/{{ $checkin }}/{{ $checkout }}/{{ $cekkamar->id }}"
                                            class="button" align="center">Booking</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>
                @endisset
            </section>
        </div>
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @php $i=1; @endphp
                                @isset($tempat_baru)
                                    <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                                        <div class="col-6">
                                            <h3 class="mb-3">Villa Baru </h3>
                                        </div>
                                        @php $i++@endphp
                                        <div class="row">
                                            @foreach ($tempat_baru as $t)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280" style="width:315px;height:215px;"
                                                            src="{{ asset('images/' . $t->foto) }}">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $t->nama }}</h4>
                                                            <i class="fas fa-money-bill"> Rp.{{ number_format($t->harga) }} /
                                                                malam</i>
                                                            <p class="card-text" align="justify">
                                                                {{ substr($t->deskripsi, 0, 100) }} <a
                                                                    href="/explore-penginapan-detail/{{ $t->id }}"
                                                                    target="_blank">read
                                                                    more...</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endisset
                                @isset($tempat_murah)
                                    <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                                        <div class="col-6">
                                            <h3 class="mb-3">Villa Termurah </h3>
                                        </div>
                                        @php $i++@endphp
                                        <div class="row">
                                            @foreach ($tempat_murah as $tm)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280" style="width:315px;height:215px;"
                                                            src="{{ asset('images/' . $tm->foto) }}">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $tm->nama }}</h4>
                                                            <i class="fas fa-money-bill"> Rp.{{ number_format($tm->harga) }}
                                                                /
                                                                malam</i>
                                                            <p class="card-text" align="justify">
                                                                {{ substr($t->deskripsi, 0, 100) }} <a
                                                                    href="/explore-penginapan-detail/{{ $tm->id }}"
                                                                    target="_blank">read
                                                                    more...</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endisset
                                @isset($tempat_lama)
                                    <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                                        <div class="col-6">
                                            <h3 class="mb-3">Villa Lama</h3>
                                        </div>
                                        @php $i++@endphp
                                        <div class="row">
                                            @foreach ($tempat_lama as $tl)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280"
                                                            style="width:315px;height:215px;"
                                                            src="{{ asset('images/' . $tl->foto) }}">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $tl->nama }}</h4>
                                                            <i class="fas fa-money-bill"> Rp.{{ number_format($tl->harga) }}
                                                                /
                                                                malam</i>
                                                            <p class="card-text" align="justify">
                                                                {{ substr($tl->deskripsi, 0, 100) }} <a
                                                                    href="/explore-penginapan-detail/{{ $tl->id }}"
                                                                    target="_blank">read
                                                                    more...</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endisset

                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @isset($penginapan)
            @if (count($penginapan) > 0)
                <section class="penginapan section" id="penginapan">
                    <h2 class="penginapan__title">Hotel Disekitar</h2>
                    <div class="penginapan__container container grid">
                        @foreach ($penginapan as $key => $tempat2)
                            <!--==================== PLACES CARD 1 ====================-->
                            <div class="penginapan__card">
                                <img src="{{ asset('images') }}/{{ $tempat2->foto }}" class="img-thumbnail" alt="Responsive image">

                                <div class="penginapan__content">
                                    <span class="penginapan__rating">
                                        <i class="ri-star-line penginapan__rating-icon"></i>
                                    </span>

                                    <div class="penginapan__data">
                                        <h3 class="penginapan__subtitle">{{ $tempat2->nama }}</h3>

                                        <span class="penginapan__price">{{ $tempat2->name }}</span>
                                    </div>
                                </div>
                                <a target="_blank" href="/explore-hotel/{{ $tempat2->id }}">
                                    <button class="button button--flex penginapan__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>

                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endisset

    </main>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
@section('scripts')
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $(".checkin-date").on('blur', function() {
                var _checkindate = $(this).val();
                //Ajax
                $.ajax({
                    url: "{{ url('explore-penginapan/booking') }}/" + _checkindate,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".list-tempat").html('<option>---Loading---</option>');
                    },
                    success: function(res) {
                        var _html = '';
                        $.each(res.data, function(index, row) {
                            _html += '<option value="' + row.id + ' ">' + row.nama +
                                '</option>';
                        });
                        $(".list-tempat").html(_html);
                    }
                });
            });
        });
    </script> --}}
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
    <script>
        document.getElementById("outer3").addEventListener("click", toggleState3);

        // function toggleState3() {
        //     let galleryView = document.getElementById("galleryView")
        //     let tilesView = document.getElementById("tilesView")
        //     let outer = document.getElementById("outer3");
        //     let slider = document.getElementById("slider3");
        //     let tilesContainer = document.getElementById("tilesContainer");
        //     if (slider.classList.contains("active")) {
        //         slider.classList.remove("active");
        //         outer.classList.remove("outerActive");
        //         galleryView.style.display = "flex";
        //         tilesView.style.display = "none";

        //         while (tilesContainer.hasChildNodes()) {
        //             tilesContainer.removeChild(tilesContainer.firstChild)
        //         }
        //     } else {
        //         slider.classList.add("active");
        //         outer.classList.add("outerActive");
        //         galleryView.style.display = "none";
        //         tilesView.style.display = "flex";

        //         for (let i = 0; i < imgObject.length - 1; i++) {
        //             let tileItem = document.createElement("div");
        //             tileItem.classList.add("tileItem");
        //             tileItem.style.background = "url(" + imgObject[i] + ")";
        //             tileItem.style.backgroundSize = "contain";
        //             tilesContainer.appendChild(tileItem);
        //         }
        //     };
        // }

        //     let imgObject = [
        //         "https://placeimg.com/450/450/any",
        //         "https://placeimg.com/450/450/animals",
        //         "https://placeimg.com/450/450/architecture",
        //         "https://placeimg.com/450/450/nature",
        //         "https://placeimg.com/450/450/people",
        //         "https://placeimg.com/450/450/tech",
        //         "https://picsum.photos/id/1/450/450",
        //         "https://picsum.photos/id/8/450/450",
        //         "https://picsum.photos/id/12/450/450",
        //         "https://picsum.photos/id/15/450/450",
        //         "https://picsum.photos/id/5/450/450",
        //     ];

        //     let mainImg = 0;
        //     let prevImg = imgObject.length - 1;
        //     let nextImg = 1;

        //     function loadGallery() {

        //         let mainView = document.getElementById("mainView");
        //         mainView.style.background = "url(" + imgObject[mainImg] + ")";

        //         let leftView = document.getElementById("leftView");
        //         leftView.style.background = "url(" + imgObject[prevImg] + ")";

        //         let rightView = document.getElementById("rightView");
        //         rightView.style.background = "url(" + imgObject[nextImg] + ")";

        //         let linkTag = document.getElementById("linkTag")
        //         linkTag.href = imgObject[mainImg];

        //     };

        //     function scrollRight() {

        //         prevImg = mainImg;
        //         mainImg = nextImg;
        //         if (nextImg >= (imgObject.length - 1)) {
        //             nextImg = 0;
        //         } else {
        //             nextImg++;
        //         };
        //         loadGallery();
        //     };

        //     function scrollLeft() {
        //         nextImg = mainImg
        //         mainImg = prevImg;

        //         if (prevImg === 0) {
        //             prevImg = imgObject.length - 1;
        //         } else {
        //             prevImg--;
        //         };
        //         loadGallery();
        //     };

        //     document.getElementById("navRight").addEventListener("click", scrollRight);
        //     document.getElementById("navLeft").addEventListener("click", scrollLeft);
        //     document.getElementById("rightView").addEventListener("click", scrollRight);
        //     document.getElementById("leftView").addEventListener("click", scrollLeft);
        //     document.addEventListener('keyup', function(e) {
        //         if (e.keyCode === 37) {
        //             scrollLeft();
        //         } else if (e.keyCode === 39) {
        //             scrollRight();
        //         }
        //     });

        //     loadGallery();
        // 
    </script>
@endsection
@endsection
