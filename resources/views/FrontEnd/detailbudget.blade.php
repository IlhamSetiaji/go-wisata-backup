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
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1>Masukan Data Pembelian</h1>
            </div>
        </div>
        <section class="row">
            <div class="col-12 col-lg-9 mt-2">
                <form action="{{ route('front.budget.pesan') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    {{-- @php
                        $data = App\Models\BookingPaket::max('kode_booking');
                        $huruf = 'BP';
                        $urutan = (int) substr($data, 3, 3);
                        $urutan++;
                        $kode_booking = $huruf . sprintf('%04s', $urutan);
                        
                    @endphp --}}


                    {{-- <input type="text" hidden name="kode_booking" value="{{ $kode_booking }}"> --}}
                    {{-- @for ($i = 1; $i <= $jml_orang; $i++) --}}
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-id-card-o"></i> Data Pembelian
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {{-- @php
                                            kodetiket
                                            $data = App\Models\PesertaPaket::max('kode_peserta');
                                            $urut = (int) $data;
                                            $urut++;
                                            $huruff = 'PP-';
                                            $kode_peserta = $huruff . $urut . uniqid();
                                        @endphp
                                        <input type="text" hidden name="kode_peserta" value="{{ $kode_peserta }}"> --}}
                                        <input type="text" hidden name="paket_id" value="{{ $paket->id }}">
                                        <div class="col-md-4 mt-2">
                                            <label>Nama Pembeli *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                                        id="first-name-icon" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label>Email *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                                        id="first-name-icon" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label>No Telepon *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" name="telp" value="{{ Auth::user()->telp }}"
                                                        id="first-name-icon" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label>Jumlah Orang *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" name="jml_orang"
                                                        id="jml_orang" value="{{ $orang }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label>Jumlah Hari *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" name="jml_hari"
                                                        id="jml_hari" value="{{ $hari }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label>Rencana Wisata*</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="date" class="form-control" name="tanggal_perjalanan" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label>Biaya</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="total_biaya"
                                                        value="{{ $biaya }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endfor --}}
                    <button class="btn btn-primary mt-3" type="submit"
                        onclick=" return confirm('Yakin ingin pesan?')">Pesan</button>
                </form>
            </div>
            <div class="col-12 col-lg-3 mt-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Pesanan</h4>
                    </div>
                    <div class="card-content pb-4">
                        <ul class="mt-2">
                            <li> 1. {{ $paket->nama_paket }}(Harga perhari : {{ $paket->harga }})</li>
                        </ul>
                        {{-- <div class="recent-message d-flex px-4 py-3">
                                <p>Nama paket : {{ $nama_paket }}</br>
                                    Jumlah Orang : {{ $jml_orang }} orang</br>
                                    Jumlah Hari : {{ $jml_hari }} hari</br>
                                    Harga : Rp.{{ number_format($harga) }}</br>
                                </p>
                            </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
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
