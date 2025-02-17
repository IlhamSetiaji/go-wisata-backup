@extends('admin.layouts2.master')
@section('title', 'Check Event')
@section('content')
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    @isset($cek)
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <form action="/check_order" method="get">
                    @csrf
                    <div class="form-group">
                        <h6>Checkin</h6>
                        <div class="input-group">
                            <input type="text" placeholder="Order id" class="form-control" id="order_id" name="order_id"
                                required>
                            <button class="btn btn-primary" type="submit" name="submit" value="todo">Check</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h6>Scan QR code</h6>
                <form action="/check_order" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="order_id" id="text" placeholder="scan qrcode" class="form-control">
                        <button class="btn btn-primary" type="submit" name="submit" value="todo">Check</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div>
            <script>
                let scanner = new Instascan.Scanner({
                    video: document.getElementById('preview')
                });
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        alert('No cameras found');
                    }

                }).catch(function(e) {
                    console.error(e);
                });

                scanner.addListener('scan', function(c) {
                    document.getElementById('text').value = c;
                });
            </script>
        @endisset

        @isset($kosong)
            Kode tidak valid untuk tempat ini, coba cek invoice, atau hubungi admin
            <a href="/check_order" class='sidebar-link'>
                <i class="fas fa-clipboard-check"></i>
                <span>back</span>
            </a>
        @endisset

        @isset($data)
            <section class="tasks">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card widget-todo">
                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h4 class="card-title d-flex">
                                    <i class="bx bx-check font-medium-5 pl-25 pr-75"></i> Order {{ $id }}
                                </h4>
                            </div>
                            <table class="table table-hover" id="admin">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Event</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody <tr>
                                    <td class="col-5">Reservasi Event {{ $db->event->nama }}</td>
                                    <td class="col-2">{{ $db->jml_orang }}</td>
                                    <td class="col-2">{{ number_format($db->event->harga) }}</td>
                                    <td class="col-3">Rp. {{ number_format($data->harga) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="col-lg-5">
                        <div class="card widget-todo">
                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h4 class="card-title d-flex">
                                    <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>{{ $user->cust->name }}
                                </h4>
                                <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>{{ $user->cust->email }}
                            </div>
                            <div class="card-body px-0 py-1">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="col-10">
                                            {{-- @if ($event->status == 0)
                                                <a href="{{ route('update.status.event', [$event->id]) }}"><button
                                                        class="btn btn-danger"> Inactive</button></a>
                                            @else
                                                <a href="{{ route('update.status.event', [$event->id]) }}"><button
                                                        class="btn btn-warning"> Active</button></a>
                                            @endif --}}
                                            @if (!$pay == null)
                                                @if ($pay->status_message == 'settlement')
                                                    <button class="btn disabled btn-primary"> Berhasil Dibayar</button>
                                                    @if ($ck == 1)
                                                        <a href="{{ route('update.status.bookingevent0', [$db->id]) }}"><button
                                                                class="btn btn-outline-primary"> Belum Check In</button></a>
                                                    @elseif ($ck == 2)
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        <a href="{{ route('update.status.bookingevent1', [$db->id]) }}"><button
                                                                class="btn btn-outline-warning"> Check Out</button></a>
                                                    @elseif ($ck == 3)
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        <button class="btn disabled btn-primary"> Selesai</button>
                                                    @endif
                                                @elseif ($pay->status_message == 'pending')
                                                    <button class="btn disabled btn-warning"> Menunggu Dibayar</button>
                                                @elseif ($pay->status_message == 'expire')
                                                    <button class="btn disabled btn-danger"> Expire</button>
                                                @elseif ($pay->status_message == 'cancel')
                                                    <button class="btn disabled btn-danger"> Dibatalkan</button>
                                                @endif
                                            @else
                                                <button class="btn disabled btn-primary"> Belum Membayar</button>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col">
                    <div class="card widget-todo">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <h4 class="card-title d-flex">
                                <i class="bx bx-check font-medium-5 pl-25 pr-75"></i> Data Peserta
                            </h4>
                            <table class="table table-hover" id="admin">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Peserta</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Kedatangan</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($db2 as $key => $value)
                                        @php
                                            $peserta = App\Models\PesertaEvent::where('kode_booking', $value->kode_booking)->get();
                                        @endphp
                                        @foreach ($peserta as $p)
                                            <tr>
                                                <td>
                                                    {{ $p->nama_peserta }}
                                                </td>
                                                <td>
                                                    {{ $p->telp }}
                                                </td>
                                                <td>
                                                    {{ $p->email }}
                                                </td>
                                                @if ($p->kedatangan == '0')
                                                    <td>
                                                        <a href="{{ route('update.status.pesertaevent', [$p->id]) }}"><button
                                                                class="btn btn-outline-primary"> Check In</button></a>
                                                    </td>
                                                @elseif($p->kedatangan == '1')
                                                    <td>
                                                        <a href="#"><button class="btn btn-outline-succes">
                                                                Hadir</button></a>
                                                    </td>
                                                @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <td scope="col"> Checkin ( {{ $db->checkin }} )</td>
                                <td scope="col">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td scope="col"> Checkout ( {{ $db->checkout }} )</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
        @endisset


    @endsection
