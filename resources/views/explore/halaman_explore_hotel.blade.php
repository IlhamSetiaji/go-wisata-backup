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
            <img src="{{ asset('images') }}/{{ $hotel->foto }}" alt="" class="home__img">

            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__data-title">{{ $hotel->nama }}<br> <b>{{ $hotel->name }}</b></h1>
                    <form action="/explore-hotel/{{ $hotel->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input class="form-control" name="hotel_id" type="hidden" value="{{ $hotel->id }}">
                            <input type="text" class="form-control" placeholder="Check In" disabled>
                            <input type="date" name="checkin" id="datefield"
                                class="form-control checkin-date @error('checkin') is-invalid @enderror" required>
                            <input type="text" class="form-control" placeholder="Check Out" disabled>
                            <input type="date" name="checkout" id="datefield2"
                                class="form-control checkout-date @error('checkout') is-invalid @enderror" required>
                            <select class="form-select list-tempat" name="kamar_type">
                                <option selected value=''>Pilih Tipe Kamar</option>
                                <option value="standard"> Standar </option>
                                <option value="vip"> VIP </option>
                            </select>
                            <input type="text" name="jumlah_orang" placeholder="jumlah orang"
                                class="form-control checkout-date @error('jml_orang') is-invalid @enderror" required>
                            <button class="button" type="submit">Search Kamar</button>
                        </div>
                    </form>
                    <a href="/explore" class="button">Explore</a>
                    @isset($cekkamar)
                        <a href="#cek" class="button">Cek Hasil</a>
                    @endisset
                </div>

            </div>
        </section>
        <div class="container">
            {!! Toastr::message() !!}

            &nbsp;
            <section class="row">
                @isset($cekkamar)
                    <section class="experience section">
                        <h2 class="section__title"> Kamar di {{ $tempat->name }} <br> Di Tanggal
                            {{ $formatted_dt1->format('Y-m-d') }} sampai {{ $formatted_dt2->format('Y-m-d') }}</h2>
                    </section>
                    <!--==================== ABOUT ====================-->
                    <section class="about section" id="cek">
                        @foreach ($cekkamar as $key => $cekkamar)
                            <div class="about__container container grid">
                                <div class="about__data">
                                    <h2 class="section__title about__title"> {{ $cekkamar->name }}</h2>
                                    <p class="about__description" align="justify">{{ $cekkamar->deskripsi }}
                                        <br>{{ $cekkamar->deskripsi_harga }} Rp.{{ number_format($cekkamar->harga) }}
                                    </p>
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    
                                    if ($formatted_dt1 > $formatted_dt2) {
                                        $durasi = -1 * $formatted_dt1->diffInDays($formatted_dt2);
                                    } else {
                                        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
                                    }
                                    for ($i = 0; $i < $durasi; $i++) {
                                        $eventtgl = date('Y-m-d ', strtotime('+' . $i . 'day', strtotime($formatted_dt1)));
                                        $booked = App\Models\EventBooking::where('date', $eventtgl)
                                            ->where('tempat_id', $tempat_id)
                                            ->where('title', 'Booked')
                                            ->where('kamar_id', $cekkamar->kode_kamar)
                                            ->exists();
                                    }
                                    ?>
                                    @if ($booked == true)
                                        Booked
                                    @else
                                        <form action="{{ url('/penginapanpesan/' . $cekkamar->kode_kamar) }} " method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input class="form-control" name="kode_kamar" type="hidden"
                                                value="{{ $cekkamar->kode_kamar }}">
                                            <input class="form-control" name="tempat_id" type="hidden"
                                                value="{{ $tempat->id }}">
                                            <input class="form-control" name="tempat_name" type="hidden"
                                                value="{{ $tempat->name }}">
                                            <input class="form-control" name="kamar_id" type="hidden"
                                                value="{{ $cekkamar->kode_kamar }}">
                                            <input class="form-control" name="jumlah_kamar" type="hidden" value="1">
                                            <input class="form-control" name="checkin" type="hidden"
                                                value="{{ $formatted_dt1->format('Y-m-d') }}">
                                            <input class="form-control" name="checkout" type="hidden"
                                                value="{{ $formatted_dt2->format('Y-m-d') }}">
                                            <input class="form-control" name="jumlah_orang" type="hidden"
                                                value="{{ $jumlah_orang }}">
                                            <input class="form-control" name="durasi" type="hidden"
                                                value="{{ $durasi }}">
                                            <button class="button" type="submit">
                                                Booking
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <div class="about__img">
                                    <div class="about__img-overlay">
                                        <img src="{{ asset('images') }}/{{ $cekkamar->image }}" alt=""
                                            class="about__img-two">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>
                @endisset
            </section>
            <!--==================== Kamar====================-->
            <section class="discover section" id="kamar">
                <h2 class="section__title">Kamar <br> Yang Tersedia</h2>

                <div class="discover__container container swiper-container">
                    <div class="swiper-wrapper">
                        @if (count($kamar) > 0)
                            @foreach ($kamar as $key => $whn)
                                <!--==================== DISCOVER 1 ====================-->
                                <div class="discover__card swiper-slide">
                                    <img src="{{ asset('images') }}/{{ $whn->image }}" alt=""
                                        class="discover__img">
                                    <div class="discover__data">

                                        <h2 class="discover__title">{{ $whn->name }}</h2>

                                        <span class="discover__description">
                                            @if ($whn->harga == '0' || $whn->harga == null)
                                                Free
                                            @else
                                                <a disabled class="button"> Rp.{{ number_format($whn->harga) }}/
                                                    Malam</a>
                                            @endif

                                        </span>
                                    </div>


                                </div>
                            @endforeach
                        @else
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
@section('scripts')
    <script type="text/javascript">
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
    </script>
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

        function toggleState3() {
            let galleryView = document.getElementById("galleryView")
            let tilesView = document.getElementById("tilesView")
            let outer = document.getElementById("outer3");
            let slider = document.getElementById("slider3");
            let tilesContainer = document.getElementById("tilesContainer");
            if (slider.classList.contains("active")) {
                slider.classList.remove("active");
                outer.classList.remove("outerActive");
                galleryView.style.display = "flex";
                tilesView.style.display = "none";

                while (tilesContainer.hasChildNodes()) {
                    tilesContainer.removeChild(tilesContainer.firstChild)
                }
            } else {
                slider.classList.add("active");
                outer.classList.add("outerActive");
                galleryView.style.display = "none";
                tilesView.style.display = "flex";

                for (let i = 0; i < imgObject.length - 1; i++) {
                    let tileItem = document.createElement("div");
                    tileItem.classList.add("tileItem");
                    tileItem.style.background = "url(" + imgObject[i] + ")";
                    tileItem.style.backgroundSize = "contain";
                    tilesContainer.appendChild(tileItem);
                }
            };
        }

        let imgObject = [
            "https://placeimg.com/450/450/any",
            "https://placeimg.com/450/450/animals",
            "https://placeimg.com/450/450/architecture",
            "https://placeimg.com/450/450/nature",
            "https://placeimg.com/450/450/people",
            "https://placeimg.com/450/450/tech",
            "https://picsum.photos/id/1/450/450",
            "https://picsum.photos/id/8/450/450",
            "https://picsum.photos/id/12/450/450",
            "https://picsum.photos/id/15/450/450",
            "https://picsum.photos/id/5/450/450",
        ];

        let mainImg = 0;
        let prevImg = imgObject.length - 1;
        let nextImg = 1;

        function loadGallery() {

            let mainView = document.getElementById("mainView");
            mainView.style.background = "url(" + imgObject[mainImg] + ")";

            let leftView = document.getElementById("leftView");
            leftView.style.background = "url(" + imgObject[prevImg] + ")";

            let rightView = document.getElementById("rightView");
            rightView.style.background = "url(" + imgObject[nextImg] + ")";

            let linkTag = document.getElementById("linkTag")
            linkTag.href = imgObject[mainImg];

        };

        function scrollRight() {

            prevImg = mainImg;
            mainImg = nextImg;
            if (nextImg >= (imgObject.length - 1)) {
                nextImg = 0;
            } else {
                nextImg++;
            };
            loadGallery();
        };

        function scrollLeft() {
            nextImg = mainImg
            mainImg = prevImg;

            if (prevImg === 0) {
                prevImg = imgObject.length - 1;
            } else {
                prevImg--;
            };
            loadGallery();
        };

        document.getElementById("navRight").addEventListener("click", scrollRight);
        document.getElementById("navLeft").addEventListener("click", scrollLeft);
        document.getElementById("rightView").addEventListener("click", scrollRight);
        document.getElementById("leftView").addEventListener("click", scrollLeft);
        document.addEventListener('keyup', function(e) {
            if (e.keyCode === 37) {
                scrollLeft();
            } else if (e.keyCode === 39) {
                scrollRight();
            }
        });

        loadGallery();
    </script>
@endsection
@endsection
