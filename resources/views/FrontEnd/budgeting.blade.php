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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!--=============== CSS ===============-->
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('./vendor/depan/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <title>GoWisata.</title>


</head>

<body>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <h1 class="my-4">
            Paket yang tersedia
        </h1>

        <!-- Project One -->
        @if (count($paket) != '')

            @foreach ($paket as $paket)
                <div class="row">
                    <div class="col-md-7">

                        @for ($i = 0; $i < count($gambar); $i++)
                            @if ($gambar[$i]['paket_id'] == $paket->id)
                                <img class="img-fluid rounded mb-3 mb-md-0"
                                    src="{{ asset('images') . '/' . $gambar[$i]['gambar'] }}" alt="">
                            @endif
                        @endfor
                        <?php
                        $cekPaket = App\Models\tb_paketwisata::where('paket_id', $paket->id)->get();
                        ?>

                        @if (count($cekPaket) == null)
                            <img class="img-fluid rounded mb-3 mb-md-0" {{-- src="{{ 'https://source.unsplash.com/700x300/?' . $paket->kategori()->first()->nama_kategori }}" --}} alt="">
                        @else
                        @endif
                    </div>
                    <div class="col-md-5">
                        <h3>{{ $paket->nama_paket }}</h3>
                        <p>Harga : Rp{{ $paket->harga }},00 </p>
                        {{-- <p>Kategori Paket : {{ $paket->kategori()->first()->nama_kategori }} </p> --}}
                        <p>Detail:</p>
                        <ul>
                            <li>Hari: {{ $paket->jml_hari }} </li>
                            <li>Orang: {{ $paket->jml_orang }} </li>
                            <li>
                                <h5>Wisata</h5>
                                <ul>
                                    @foreach ($wisatas as $items)
                                        @foreach ($items as $wisata)
                                            @if ($wisata->paket_id == $paket->id)
                                                <li>{{ $wisata->tempat->name }}</li>
                                            @else
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <h5>Penginapan</h5>
                                <ul>
                                    @foreach ($penginapans as $items)
                                        @foreach ($items as $penginapan)
                                            @if ($penginapan->paket_id == $paket->id)
                                                {{-- <li>{{ $penginapan->tempat->name }}</li> --}}
                                            @else
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </li>
                            <li>


                            </li>
                        </ul>
                        {{-- <p>Kamar : {{ $paket->id_kamar }} </p> --}}
                        <form action="{{ '/budgeting/detail/' . Crypt::encrypt($paket->id) }}" method="get"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="{{ $paket->id }}" type="hidden" name="paket_id" hidden>
                            <input type="text" value="{{ $input['jml_hari'] }}" type="hidden" name="jml_orang"
                                hidden>
                            <input type="text" value="{{ $input['jml_orang'] }}" type="hidden" name="jml_hari"
                                hidden>
                            {{-- <input type="text" value="{{ $paket->id }}" type="hidden" name="biaya" hidden> --}}

                            <button class="btn btn-primary" type="submit">Pesan</button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif

        <!-- Pagination -->
        {{-- <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">1</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">3</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul> --}}

    </div>
    <!-- /.container -->

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
                        <!--<li class="footer__item">-->
                        <!--    <a href="" class="footer__link">+6285882218939</a>-->
                        <!--</li>-->
                        <li class="footer__item">
                            <a href="mailto:gowisata.kabmadiun@gmail.com
                            Indonesia"
                                class="footer__link">gowisata.kabmadiun@gmail.com</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
</body>

</html>
