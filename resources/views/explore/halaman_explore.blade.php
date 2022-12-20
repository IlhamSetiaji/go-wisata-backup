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
                        <h3 class="card-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Desa Wisata</h3>
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
                            <h3 class="card-title"><i class="fa fa-calendar" aria-hidden="true"></i> Event</h3>
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
                            <h3 class="card-title"><i class="fa fa-coffee" aria-hidden="true"></i> Kuliner</h3>
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
                            <h3 class="card-title"><i class="fa fa-bed" aria-hidden="true"></i> Penginapan</h3>
                            <p class="card-text" align="justify">Explore penginapan memberikan beragam informasi mengenai
                                hotel , villa dan homestay yang tersedia, jika Anda membutuhkan tempat yang nyaman untuk liburan.
                            </p>
                            <a href="/explore-penginapan" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Merchandise</h5>
                            <p class="card-text" align="justify">Explore merchandise memberikan beragam informasi produk
                                atau pernak-pernik khas daerah, untuk Anda yang tertarik membeli oleh-oleh.
                            </p>
                            <a href="#" class="button">Explore</a>
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fa fa-university" aria-hidden="true"></i> Penyewaan Tempat</h3>
                            <p class="card-text" align="justify">Explore penyewaan tempat memberikan informasi tempat yang
                                bisa disewa untuk keperluan Wedding, Acara Keluarga, dan lain-lain.
                            </p>
                            <a href="/explore-penyewaan-tempat" class="button">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fa fa-money-bill" aria-hidden="true"></i> E-Budgeting</h3>
                            <p class="card-text" align="justify">E-Budgeting adalah sebuah fitur rekomendasi paket wisata berdasarkan budget anda
                            </p>
                            <button data-bs-toggle="modal"
                            data-bs-target="#form-budgeting" class="button">Explore</button>
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
    <div class="modal fade" id="form-budgeting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">E-Budgeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="e-budgeting">
                    <form action="{{ route('front.budget', Crypt::encrypt(rand())) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="budget" class="form-label">Berapa Budget Anda? Biar Mimin Bantu
                                        Hitung</label>
                                    <input type="number" class="form-control" name="jml_budget" required
                                        id="jml_budget">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="desa" class="form-label">Desa yang Mau Anda Kunjungi</label>
                                    <select class="form-select" aria-label="Default select example" id="desa"
                                    name="desa">
                                    <option selected>Pilih desa</option>
                                    @foreach ($desas as $desa)
                                    <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="budget" class="form-label">Berapa Orang?</label>
                                    <input type="number" class="form-control" name="jml_orang" required
                                        id="jml_orang">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="budget" class="form-label">Rencana Liburan Berapa
                                        Hari?</label>
                                    <div id="form-hari">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <p>Kategori Wisata</p>
                                <div class="row">
                                    
                                    @foreach ($ctg_wisata as $item)
                                    <div class="col">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"  name="kategori[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          {{ $item->nama_kategori }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                              </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="close-budgeting">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {
                $('#desa').on('change', function() {
                    let desa = $('#desa').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-penginapan') }}",
                        data: {
                            desa_id: desa
                        },
                        cache: false,

                        success: function(msg) {
                            $('#form-hari').html(msg);
                        },
                        error: function(data) {
                            console.log('error: ', data)
                        }
                    });
                })
            })
        });
    </script>
@endsection
