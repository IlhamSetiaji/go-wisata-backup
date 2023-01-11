@extends('pesanan.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <body>
        <nav class="navbar navbar-light">
            <div class="container d-block">
                <a href="{{ url('/') }}">
                    <button class="btn btn-outline-primary me-1 mb-1"><i class="fas fa-home"></i></button>
                </a>
                <a href="{{ url('/profile') }}">
                    <button class="btn btn-outline-primary me-1 mb-1"><i class="far fa-id-card"></i></button>
                </a>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                

                {{-- <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8">

                                <h6 class="text-muted font-semibold">Pesananku</h6>
                                <h6 class="font-extrabold mb-0">{{ App\Models\Tiket::where('user_id', Auth::user()->id)->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
                {{-- <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Saldo Anda</h6>
                                    <h5 class="font-extrabold mb-0">Rp.
                                        {{ number_format(App\Models\User::where('id', Auth::user()->id)->pluck('balance')->sum()) }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                       
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pilih Pembayaran</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('status', 0)->where('type_bayar', null)->count() }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pending</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('check', 'pending')->count() }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Bayar Langsung</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('type_bayar', 'bayar langsung')->count() }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">E-Wallet</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('type_bayar', 'Epay')->count() }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Cancel / Expire</h6>
                                    <?php $cancel =
                                        App\Models\Tiket::where('user_id', Auth::user()->id)
                                            ->where('check', 'cancel')
                                            ->count() +
                                        App\Models\Tiket::where('user_id', Auth::user()->id)
                                            ->where('check', 'expire')
                                            ->count(); ?>

                                    <h6 class="font-extrabold mb-0"> {{ $cancel }}</h6>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Berhasil</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('check', 'settlement')->count() }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                {{-- <div class="card-header">
                <h4 class="card-title text-center">Semua Pesanan An. {{ Auth::user()->name }} </h4>
            </div> --}}
                <div class="card-body">
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="pesan">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    $grandtotal = 0; ?>

                                    @if (count($tiket) > 0)
                                        @foreach ($tiket as $key => $tiket)
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    {{-- @if (App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->distinct()->count() > 1)
                                                        {{ substr(App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->pluck('name')->first(),0,20) }}
                                                        , ...
                                                    @else
                                                        {{ substr(App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->pluck('name')->first(),0,20) }}
                                                    @endif --}}
                                                    {{ $tiket->kode }}
                                                </td>
                                                <td>
                                                    {{ substr(App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->pluck('kategori')->first(),0,15) }}
                                                </td>
                                                <td>
                                                    {{ substr(App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->pluck('tanggal_a')->first(),0,10) }}
                                                </td>
                                                <td>
                                                    @if ($tiket->harga <= 0)
                                                        Gratis
                                                    @else
                                                        Rp. {{ number_format($tiket->harga) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('/pesanan/detail/' . $tiket->kode) }}"><button
                                                            class="btn  btn-outline-info"> Detail Pesanan </a>
                                                </td>
                                                <td>

                                                    @foreach (App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->get() as $dt)
                                                        @if ($dt->kategori == 'events')
                                                            @foreach (App\Models\Event::where('id', $dt->id_produk)->get() as $de)
                                                                @php
                                                                    $stoksekarang = $de->kapasitas_awal - $de->kapasitas_akhir;
                                                                @endphp
                                                                @if ($tiket->status == 0 && $stoksekarang < $dt->jumlah)
                                                                    <button class="btn btn-danger">Tiket Sold Out</button>
                                                                @elseif ($tiket->status == 1)
                                                                    @foreach (App\Models\Pay::where('kodeku', $tiket->kode)->get() as $status)
                                                                        @if ($status->transaction_status == 'settlement')
                                                                            <div class="btn-group dropdown me-1 mb-1">
                                                                                <a
                                                                                    href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                                        class="btn btn-outline-primary">Berhasil
                                                                                        Dibayar</button></a>
                                                                                <button type="button"
                                                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false"
                                                                                    data-reference="parent">
                                                                                    <span class="sr-only"></span>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ url('/my-tiket/print/' . $tiket->kode) }}"
                                                                                        target="_blank">Print</a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ url('/qrcode/' . $tiket->kode) }}"
                                                                                        target="_blank">QrCode</a>


                                                                                </div>
                                                                            </div>
                                                                        @elseif ($status->transaction_status == 'pending' && $stoksekarang < $dt->jumlah)
                                                                            <button class="btn btn-danger">Tiket Sold
                                                                                Out</button>
                                                                        @elseif ($status->transaction_status == 'pending' && $stoksekarang >= $dt->jumlah)
                                                                            <a
                                                                                href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                                    class="btn btn-warning">Menunggu
                                                                                    Dibayar</button></a>
                                                                        @elseif ($status->transaction_status == null)

                                                                        @elseif ($status->transaction_status == 'expire')
                                                                            <a
                                                                                href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                                    class="btn btn-danger"> &nbsp;
                                                                                    &nbsp;
                                                                                    &nbsp;
                                                                                    &nbsp; &nbsp;Expire &nbsp;
                                                                                    &nbsp;
                                                                                    &nbsp;
                                                                                    &nbsp;</button></a>
                                                                        @elseif ($status->transaction_status == 'cancel')
                                                                            <a
                                                                                href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                                    class="btn btn-danger">
                                                                                    &nbsp;
                                                                                    &nbsp;
                                                                                    &nbsp;Dibatalkan&nbsp;
                                                                                    &nbsp;
                                                                                    &nbsp;
                                                                                </button></a>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <a href="{{ url('bayar', [$tiket->id]) }}"><button
                                                                            class="btn btn-primary"> Pilih
                                                                            Pembayaran</button></a>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @if ($tiket->status == 0 && $tiket->type_bayar == 'bayar langsung')
                                                                {{-- Pembayaran Langsung --}}
                                                                <div class="btn-group dropdown me-1 mb-1">
                                                                    <a href="#"><button
                                                                            class="btn btn-outline-primary">Pembayaran
                                                                            Langsung</button></a>
                                                                    <button type="button"
                                                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false" data-reference="parent">
                                                                        <span class="sr-only"></span>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/my-tiket/print/' . $tiket->kode) }}"
                                                                            target="_blank">Print</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/qrcode/' . $tiket->kode) }}"
                                                                            target="_blank">QrCode</a>

                                                                    </div>
                                                                </div>
                                                            @elseif($tiket->status == 0 && $tiket->type_bayar == 'Epay')
                                                                <div class="btn-group dropdown me-1 mb-1">
                                                                    <a href="#"><button
                                                                            class="btn btn-outline-primary">Sudah
                                                                            Dibayar
                                                                            via
                                                                            Epay</button></a>
                                                                    <button type="button"
                                                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false" data-reference="parent">
                                                                        <span class="sr-only"></span>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/my-tiket/print/' . $tiket->kode) }}"
                                                                            target="_blank">Print</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/qrcode/' . $tiket->kode) }}"
                                                                            target="_blank">QrCode</a>

                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if ($tiket->status == 0)
                                                        <a href="{{ url('bayar', [$tiket->id]) }}"><button
                                                                class="btn btn-primary"> Pilih
                                                                Pembayaran</button></a>
                                                    @elseif($tiket->status == 1)
                                                        @foreach (App\Models\Pay::where('kodeku', $tiket->kode)->get() as $status)
                                                            @if ($status->transaction_status == 'settlement')
                                                                <div class="btn-group dropdown me-1 mb-1">
                                                                    <a href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                            class="btn btn-outline-primary">Berhasil
                                                                            Dibayar</button></a>
                                                                    <button type="button"
                                                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false" data-reference="parent">
                                                                        <span class="sr-only"></span>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/my-tiket/print/' . $tiket->kode) }}"
                                                                            target="_blank">Print</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/qrcode/' . $tiket->kode) }}"
                                                                            target="_blank">QrCode</a>

                                                                    </div>
                                                                </div>
                                                            @elseif ($status->transaction_status == 'pending')
                                                                <a href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                        class="btn btn-warning">Menunggu
                                                                        Dibayar</button></a>

                                                                {{-- <a href="{{ route('payment.cancel',[$tiket->kode])}}"><button class="btn btn-secondary"> Cancel</button></a> --}}
                                                            @elseif ($status->transaction_status == null)

                                                            @elseif ($status->transaction_status == 'expire')
                                                                <a href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                        class="btn btn-danger"> &nbsp;
                                                                        &nbsp;
                                                                        &nbsp;
                                                                        &nbsp; &nbsp;Expire &nbsp; &nbsp;
                                                                        &nbsp;
                                                                        &nbsp;</button></a>
                                                            @elseif ($status->transaction_status == 'cancel')
                                                                <a href="{{ url('bayar/status', [$tiket->kode]) }}"><button
                                                                        class="btn btn-danger"> &nbsp;
                                                                        &nbsp;
                                                                        &nbsp;Dibatalkan&nbsp; &nbsp;
                                                                        &nbsp;
                                                                    </button></a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($tiket->status == 0)
                                                        <form class="forms-sample"
                                                            action="{{ route('transaksi.batal', [$tiket->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn bt-danger"
                                                                onclick="return confirm('Ingin Menghapus Pesanan ini?')"><i
                                                                    class="bi bi-trash"></i></span> </button>
                                                        </form>
                                                    @else
                                                        @foreach (App\Models\Pay::where('kodeku', $tiket->kode)->get() as $status)
                                                            @if ($status->transaction_status == 'pending')
                                                                <form class="forms-sample"
                                                                    action="{{ route('payment.cancel', [$tiket->kode]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="submit" class="btn bt-danger"
                                                                        onclick="return confirm('Ingin Membatalkan Pesanan ini?')"><i
                                                                            class="fas fa-times"></i></span> </button>
                                                                </form>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @foreach (App\Models\Detail_transaksi::where('kode_tiket', $tiket->kode)->get() as $transaksi)
                                                        @foreach (App\Models\ReviewEvent::where('kode_tiket', $tiket->kode)->get() as $review)
                                                            @if ($tiket->check == 'settlement' && $transaksi->kategori == 'events')
                                                                @if ($review->status == '0')
                                                                    <a href="ratingevent/{{ $tiket->kode }}"><button
                                                                            class="btn btn-outline-primary me-1 mb-1">Ulas</button></a>
                                                                @elseif ($review->status == '1')
                                                                    <a target="blank"
                                                                        href="/detail/explore-event/{{ $review->event_id }}"><button
                                                                            class="btn btn-outline-success me-1 mb-1">Selesai
                                                                            Ulas</button></a>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @foreach (App\Models\ReviewVilla::where('kode_tiket', $tiket->kode)->get() as $review_tempat)
                                                            @if ($tiket->check == 'settlement' && $transaksi->kategori == 'villa')
                                                                @if ($review_tempat->status == '0')
                                                                    <a href="ratingvilla/{{ $tiket->kode }}"><button
                                                                            class="btn btn-outline-primary me-1 mb-1">Ulas</button></a>
                                                                @elseif ($review_tempat->status == '1')
                                                                    <a target="blank"
                                                                        href="/explore-penginapan-detail/{{ $review_tempat->villa_id }}"><button
                                                                            class="btn btn-outline-success me-1 mb-1">Selesai
                                                                            Ulas</button></a>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @foreach (App\Models\ReviewTempatSewa::where('kode_tiket', $tiket->kode)->get() as $reviewts)
                                                            @if ($tiket->check == 'settlement' && $transaksi->kategori == 'tempat sewa')
                                                                @if ($reviewts->status == '0')
                                                                    <a href="ratingtempatsewa/{{ $tiket->kode }}"><button
                                                                            class="btn btn-outline-primary me-1 mb-1">Ulas</button></a>
                                                                @elseif ($reviewts->status == '1')
                                                                    <a target="blank"
                                                                        href="/explore-penyewaan-tempat-detail/{{ $reviewts->tempatsewa->id }}"><button
                                                                            class="btn btn-outline-success me-1 mb-1">Selesai
                                                                            Ulas</button></a>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    @if ($tiket->check == 'settlement' && $transaksi->kategori == 'kuliner')
                                                        @foreach (App\Models\ReviewKuliner::where('kode_tiket', $tiket->kode)->get() as $reviewk)
                                                            @if ($tiket->check == 'settlement' && $transaksi->kategori == 'kuliner')
                                                                <a href="{{ route('ratingkuliner', [$tiket->kode]) }}">
                                                                    <button
                                                                        class="btn btn-outline-primary me-1 mb-1">{{ $reviewk->status == '0' ? 'Ulas' : 'Selesai Ulas' }}</button></a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        @else
                            <td>No user to display</td>
                            @endif
                            <li class="breadcrumb breadcrumb"> <a
                                    href="{{ route('pesananku') }}">{{ __('Pesananku') }}</a>
                                {{-- <li class="breadcrumb breadcrumb-right">   <a href="{{url('bayar',[$tiket->id])}}"><button class="btn btn-outline-primary"> Pilih Pembayaran</button></a> </li> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-left">
                                    <h3>Data Transaksi Paket</h3>
                                </ol>
                            </nav>
                        </div>
                        <div class="card-content">

                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="transaksi">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Booking</th>
                                            <th scope="col">Paket</th>
                                            <th scope="col">Total Biaya</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Hubungi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--  --}}
                                        {{-- {{ dd($transaksi[23]->checkin) }} --}}
                                        @if ($pakets != null)
                                        @foreach ($pakets as $paket)
                                            
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $paket->kode_booking }}</td>
                                            <td>{{ $paket->paket->nama_paket }}</td>
                                            <td>{{ $paket->total_biaya }}</td>
                                            <td>
                                                <?php if($paket->status == 1) { ?>
                                                    Belum Bayar
                                                    <?php } else if($paket->status == 0){ ?>
                                                    Batal
                                                    <?php } else if($paket->status == 3){?>
                                                    Sudah Bayar
                                                    <?php } else if($paket->status == 4){?>
                                                    Checkin
                                                    <?php } else if($paket->status == 5){?>
                                                    Selesai
                                                    <?php }?>
                                            </td>
                                            <td>
                                                <a href="wa.me/{{ $paket->paket->desa->petugas->telp }}">Hubungi Admin(Whatsapp {{ $paket->paket->desa->petugas->telp }})</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td>Belum ada transaksi</td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#pesan');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
     <script>
        let table2 = document.querySelector('#transaksi');
        new simpleDatatables.DataTable(table2);

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
@endsection
