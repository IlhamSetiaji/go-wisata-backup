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
                    <h1 class="home__data-title">Desa Wisata</h1>
                    <a href="/explore" class="button">Explore</a>
                </div>

            </div>
        </section>
        <div class="container">
            {!! Toastr::message() !!}

            <!--==================== DISCOVER ====================-->
            <section class="discover section" id="discover">
                <h2 class="section__title">Temukan Tempat Wisata <br> Di Desa Wisata Paling Menarik</h2>

                <div class="card-group">
                    @if (count($tempat) > 0)
                        @foreach ($tempat as $key => $tempat)
                            <div class="card mx-2">
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
                                <a href="{{ url('./' . $tempat->slug) }}">
                                    <button class="button button--flex place__button">
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </a>
                            </div>
                        @endforeach
                    @else
                        Sedang Liburan
                    @endif
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
