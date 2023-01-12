@extends('pesanan.master')

@section('content')

    @if (empty($desc) || count($desc) == 0)

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">
                    <button onclick="goBack()" class=""><i class="bi bi-chevron-left"></i> Kembali</button>
                </div>
            </nav>

            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">Detail Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <p>Tidak ada apapun dikeranjang.. mari pesan :)</p>
                    </div>
                </div>
            </div>


        </body>
    @else

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">


                    <button class="badge bg-primary" onclick="goBack()"><i class="bi bi-chevron-left"></i> Kembali</button>

                </div>
            </nav>


            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">Detail Pesanan
                            @if ($des->status == '1')
                                {{-- @if ($des->kedatangan == '1')
                                    <a href="#" class="btn btn-sm btn-info">Sudah Kepakai</a>
                                @else
                                    <a href="#" class="btn btn-sm btn-warning">Belum Kepakai</a>
                                @endif --}}
                        </h4>
                    @else
    @endif
    </div>
    <div class="card-body">
        <div class="card-content">

            <!-- table hover -->
            <div class="table-responsive">
                <table class="table table-hover" id="cart">
                    <thead>

                        <tr>
                            @if ($des->kategori == 'kuliner')
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                            @elseif($des->kategori == 'tiket')
                                <th></th>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sub Total</th>
                            @else
                                <th></th>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Durasi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $grandtotal = 0; ?>


                        @if ($des->kategori == 'camping')
                            <?php
                            $de = App\Models\Detail_camp::where('kode_tiket', $des->kode_tiket)->first();
                            ?>
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                A/n {{ Auth::user()->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                {{-- {{ dd($des) }} --}}
                                                {{ App\Models\Tempat::where('id', $des->tempat_id)->pluck('name')->first() }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                {{ substr($des->tanggal_a, 0, 10) }} Sampai
                                                {{ substr($des->tanggal_b, 0, 10) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tr>
                                <td></td>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>
                                    @foreach ($desc as $key => $descc)
                                        {{-- {{ dd($descc) }} --}}
                                        {{-- {{ substr($descc->id_produk,0,20) }} , --}}
                                        @foreach (App\Models\Camp::where('kode_camp', $descc->id_produk)->get() as $kc)
                                            {{-- {{ dd($kc) }} --}}
                                            {{ $kc->name }},
                                        @endforeach
                                    @endforeach

                                </td>

                                <td>
                                    {{ $des->durasi }} Hari
                                </td>
                                {{-- <td>
                                        Rp. {{ number_format($des->harga) }}
                                    </td> --}}
                            </tr>
                        @elseif($des->kategori == 'villa')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                A/n {{ Auth::user()->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <?php
                                                $kegi = App\Models\BookingVilla::where('kode_booking', $des->booking_id)->first();
                                                ?>
                                                {{ $kegi->nama_tempat }}</li>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $kegi = App\Models\BookingVilla::where('kode_booking', $des->booking_id)->first();
                                    ?>
                                    <?php
                                    $tgl_a = date('d F Y', strtotime($kegi->checkin));
                                    $tgl_b = date('d F Y', strtotime($kegi->checkout));
                                    ?>
                                    <div class="col-md-4">
                                        <label>Check in</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                {{ $tgl_a }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Check Out</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                {{ $tgl_b }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <tr>
                <td></td>
                <td>
                    {{ $no++ }}
                </td>
                <td>
                    <?php $tgl_a = date('d F Y', strtotime($des->tanggal_a)); ?>
                    {{ $des->name }}
                    {{-- x <span class="badge bg-light-success">{{ $des->jumlah }}
                                        tiket</span>. --}}

                </td>
                <td>

                    {{ $des->durasi }} hari

                </td>


            </tr>
        @elseif($des->kategori == 'tempat sewa')
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Name</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                A/n {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Tempat</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                <?php
                                $kegi = App\Models\BookingTempatSewa::where('kode_booking', $des->booking_id)->first();
                                $tempat = App\Models\TempatSewa::where('id', $kegi->ruang->tempatsewa_id)->first();
                                ?>
                                {{ $kegi->ruang->nama }},
                                {{ $tempat->nama }}</li>
                            </div>
                        </div>
                    </div>
                    <?php
                    $kegi = App\Models\BookingTempatSewa::where('kode_booking', $des->booking_id)->first();
                    // $harga_jam = $durasi * $kegi->ruang->harga;
                    ?>
                    <?php
                    $tgl_a = date('d F Y', strtotime($kegi->checkin));
                    $tgl_b = date('d F Y', strtotime($kegi->checkout));
                    $jam_a = date('H:i', strtotime($kegi->checkin));
                    $jam_b = date('H:i', strtotime($kegi->checkout));
                    
                    ?>
                    <div class="col-md-4">
                        <label>Check in</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                {{ $tgl_a }}
                                {{ $jam_a }} WIB
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Check Out</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                {{ $tgl_b }}
                                {{ $jam_b }} WIB
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <tr>
                <td></td>
                <td>
                    {{ $no++ }}
                </td>
                <td>
                    <?php $tgl_a = date('d F Y', strtotime($des->tanggal_a)); ?>
                    {{ $des->name }}
                </td>
                <td>
                    {{ $des->durasi }} * Rp.
                    {{ number_format($kegi->ruang->harga) }} / jam
                </td>
            </tr>
        @elseif($des->kategori == 'events')
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Nama Pemesan</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                A/n {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Harga Tiket</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                <?php
                                $kegi = App\Models\BookingEvent::where('kode_booking', $des->booking_id)->first();
                                $harga = $kegi->biaya / $kegi->jml_orang;
                                ?>
                                Rp.
                                {{ number_format($harga) }}
                                / orang
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal Event</label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="position-relative">
                                <?php
                                $kegi = App\Models\BookingEvent::where('kode_booking', $des->booking_id)->first();
                                $id_event = $kegi->event_id;
                                $event = App\Models\Event::where('id', $id_event)->first();
                                ?>
                                <?php
                                $tgl_a = date('d F Y', strtotime($event->tgl_buka));
                                $tgl_b = date('d F Y', strtotime($event->tgl_tutup));
                                ?>
                                {{ $tgl_a }} -
                                {{ $tgl_b }}
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <tr>
                    <td></td>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        <?php $tgl_a = date('d F Y', strtotime($des->tanggal_a)); ?>
                        {{ $des->name }} x <span class="badge bg-light-success">{{ $des->jumlah }}
                            tiket</span>
                        <?php
                        $kegi = App\Models\BookingEvent::where('kode_booking', $des->booking_id)->first();
                        $peserta = App\Models\PesertaEvent::where('kode_booking', $kegi->kode_booking)->get();
                        $i = 1;
                        ?>
                        {{-- @foreach ($peserta as $p)
                            <div class="col-md-4">
                                <label>Peserta
                                    {{ $i++ }} :
                                    {{ $p->nama_peserta }}</label>
                            </div>
                        @endforeach --}}
                    </td>
                    <td>

                        {{ $des->durasi }} hari

                    </td>


                </tr>
            @elseif($des->kategori == 'kuliner')
                @foreach ($desc as $item)
                    <tr>
                        <td>
                            <?php $tgl_a = date('d F Y', strtotime($des->tanggal_a)); ?>
                            {{ $item->name }}
                            {{-- {{ $tgl_a }} --}}
                        </td>

                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->harga }}</td>

                        {{-- <td>
                                        Rp. {{ number_format($des->harga) }}
                                    </td> --}}
                    </tr>
                @endforeach
            @elseif($des->kategori == 'tiket')
                <?php
                $tgl_a = date('d F Y', strtotime($des->tanggal_a));
                $kode = App\Models\Detail_transaksi::where('kode_tiket', $des->kode_tiket)->get();
                // dd($kode);
                ?>

                <div class="form-body">

                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    A/n
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Tempat</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    {{-- {{ dd($des) }} --}}
                                    {{ App\Models\Tempat::where('id', $des->tempat_id)->pluck('name')->first() }}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    {{ substr($des->tanggal_a, 0, 10) }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                @foreach ($desc as $key => $value)
                    <?php
                    $satuan = App\Models\Tempat::find($value->id_produk);
                    ?>
                    <tr>

                        <td></td>
                        <td>{{ $no++ }}</td>
                        <td>{{ $value->name }}</td>
                        <td>Rp. {{ number_format($satuan->htm) }}</td>
                        <td>{{ $value->jumlah }}</td>
                        <td>Rp. {{ number_format($value->harga) }}</td>

                     
                    </tr>
                @endforeach


            @elseif($des->kategori == 'penginapan')
                <?php
                $de = App\Models\Detail_booking::where('kode_tiket', $des->kode_tiket)->first();
                ?>
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    A/n
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Tempat</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    {{-- {{ dd($des) }} --}}
                                    {{ App\Models\Tempat::where('id', $des->tempat_id)->pluck('name')->first() }}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    {{ substr($des->tanggal_a, 0, 10) }}
                                    Sampai
                                    {{ substr($des->tanggal_b, 0, 10) }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <tr>
                    <td></td>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        @foreach ($desc as $key => $descc)
                            {{ App\Models\Tempat::where('id', $des->tempat_id)->pluck('name')->first() }}
                        @endforeach
                        {{--  <?php $tgl_a = date('d F Y', strtotime($des->tanggal_a)); ?>
                        {{ $des->name }}
                        <?php
                        $kamar = App\Models\Kamar::where('kode_kamar', $des['kode_kamar'])->first();
                        ?>  --}}

                    </td>

                    <td>
                        {{ $des->durasi }} Hari
                    </td>

                </tr>
            @else
                @endif

                <tr>
                    @if ($des->kategori == 'kuliner')
                    <th colspan="2"> Grand Total </th>
                        
                    @elseif($des->kategori == 'tiket')
                    <th colspan="5"> Grand Total </th>
                    @endif
                    <th> Rp. {{ number_format($tiket->harga) }}
                        @if ($tiket->type_bayar == 'Bayar Langsung')
                            (Bayar Langsung)
                        @elseif($tiket->type_bayar == 'Epay')
                            (Via Epay)
                        @endif
                    <th> </th>
                </tr>

                </tbody>
                </table>

                @if ($tiket->user_id == Auth::user()->name)
                    <li class="breadcrumb breadcrumb"> <a href="{{ route('pesananku') }}">{{ __('Pesananku') }}</a>
                    <li class="breadcrumb breadcrumb-right"> <a href="{{ url('bayar', [$tiket->id]) }}"><button
                                class="btn btn-outline-primary"> Pilih Pembayaran</button></a> </li>
                @else
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>


    </body>
    @endif
@endsection
