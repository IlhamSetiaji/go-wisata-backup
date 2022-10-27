@extends('FrontEnd.main')
@section('content')
    <main class="main">
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="{{ asset('images/setting') }}/{{ $setting->home1 }}" alt="" class="home__img">
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Temukan liburan Anda</span>
                    <h1 class="home__data-title">Banyak Event Menarik<br> <b>Bersama Kami</b></h1>
                    <form method="GET" action="/explore-event">
                        <div class="input-group mb-3">
                            <select class="form-control me-1" name="cari_by_category">
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <button class="button" type="submit">Search by category</button>
                        </div>
                    </form>
                </div>
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
        </section>
        <div class="container">
            {!! Toastr::message() !!}
            <section class="row list-event">
                <div class="col-12 col-lg-9">
                    @foreach ($event as $key => $value)
                        <?php
                        
                        $tgl_buka = date('d F Y', strtotime($value->tgl_buka));
                        $tgl_tutup = date('d F Y', strtotime($value->tgl_tutup));
                        $today = Carbon\carbon::today();
                        if ($today <= Carbon\carbon::parse($value->date_b)) {
                            $c = 1;
                        } else {
                            $c = 0;
                        }
                        ?>
                        <div class="row">
                            <div class="col-xl-3">
                            </div>
                            <div class="col-12 col-xl-9">
                                <div class="card">
                                    <div>
                                        <img class="img-fluid w-100" src="{{ asset('images') }}/{{ $value->foto }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="card-header">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">
                                                {{-- <a data-bs-toggle="modal" data-bs-target="#deskripsi{{ $value->id }}">
                                                    {{ $value->nama }}
                                                </a> --}}
                                                <a href="detail/explore-event/{{ $value->id }}" target="blank">
                                                    {{ $value->nama }}
                                                </a>
                                                @if ($value->kapasitas_akhir >= $value->kapasitas_awal)
                                                    <button class="btn btn-primary" disabled>Full</button>
                                                @endif
                                                @if ($c == 0)
                                                    <button class="btn btn-info" disabled>Terlewat</button>
                                                @endif
                                            </h5>
                                            @php
                                                $sisa = $value->kapasitas_awal - $value->kapasitas_akhir;
                                            @endphp
                                            <small>Sisa tiket = {{ $sisa }} </small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item active"> </li>
                                            @if ($value->harga <= 0)
                                                <li class="list-group-item">Tiket Gratis
                                                @else
                                                <li class="list-group-item">Harga : Rp. {{ number_format($value->harga) }}
                                            @endif
                                            </li>
                                            <li class="list-group-item">

                                                Tanggal : {{ $tgl_buka }} - {{ $tgl_tutup }}</li>
                                            <li class="list-group-item">Kapasitas : {{ $value->kapasitas_awal }} orang
                                        </ul>
                                        <br>
                                        @if ($value->kapasitas_akhir < $value->kapasitas_awal && $c == 1)
                                            <form
                                                action="/explore-event-detail/{{ $value->id }}/{{ $value->nama }}/{{ $value->harga }}/{{ $value->tgl_buka }}/{{ $value->tgl_tutup }}/{{ $value->kapasitas_akhir }}/{{ $value->kapasitas_awal }}"
                                                method="GET" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-footer d-flex justify-content-between">
                                                    <span>Jumlah orang &nbsp;&nbsp;&nbsp;</span>
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" name="kode_event"
                                                            value="{{ $value->kode_event }}">
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <input type="number" name="jml_orang" class="form-control"
                                                            aria-describedby="button-addon2"
                                                            placeholder="maksimal pesan untuk 5 orang ">
                                                        <button class="btn btn-primary" type="submit">Pesan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif



                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                    {{ $event->links() }}
                </div>

                <div class="col-12 col-lg-3 mb-4">
                    <?php
                    $allevent = App\Models\Event::orderby('created_at', 'DESC')
                        ->where('status', 1)
                        ->take(5)
                        ->get();
                    ?>
                    <form class="d-flex" method="GET" action="/explore-event">
                        @csrf
                        <input class="form-control me-2" name="cari_by_name" type="text" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                    <br />
                    <div class="card">
                        <div class="card-header">
                            <h4>Event terbaru</h4>
                        </div>
                        <div class="card-content pb-4">
                            @foreach ($allevent as $key => $value)
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="name ms-4">
                                        <h6 class="text-muted mb-0"><a href="/detail/explore-event/{{ $value->id }}"
                                                target="blank">{{ $value->nama }}</a>
                                        </h6>
                                        @if ($value->harga <= 0)
                                            <h7 class="mb-1">Gratis</h7>
                                        @else
                                            <h7 class="mb-1">Rp.{{ number_format($value->harga) }}</h7>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    @foreach ($event as $key => $value)
        <div class="modal fade text-left" id="deskripsi{{ $value->id }}" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">{{ $value->nama }}</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formyow" class="form form-horizontal" action="#" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <p align="justify">{{ $value->deskripsi }}</p></br>
                                <p align="justify">Harga : Rp. {{ number_format($value->harga) }} / orang</p>
                                <p align="justify">Lokasi : {{ $value->lokasi }}</p>
                                <p align="justify">Waktu : {{ $value->waktu_mulai }} - {{ $value->waktu_selesai }}
                                    WIB
                                </p>
                                <p align="justify">Tanggal : {{ $tgl_buka }} - {{ $tgl_tutup }} </p>
                                <p align="justify">Kapasitas : {{ $value->kapasitas_awal }} orang</p>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
