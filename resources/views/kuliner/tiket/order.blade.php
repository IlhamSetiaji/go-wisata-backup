@extends('admin.layouts2.master')
@section('title', 'Order')
@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Order</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data Order</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page">index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {!! Toastr::message() !!}
        <div class="page-content">
            <section class="row">

                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="fas fa-grip-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Order</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Detail_transaksi::where('tempat_id', $id)->count() }}</h6>
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
                                        {{-- <h6 class="text-muted font-semibold">Order belum dibayar</h6> --}}
                                        <h6 class="text-muted font-semibold">Belum Bayar</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Detail_transaksi::where('tempat_id', $id)->where('status', null)->count() }}
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
                                        <div class="stats-icon green">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        {{-- <h6 class="text-muted font-semibold">Sudah Dibayar tapi belum datang</h6> --}}
                                        <h6 class="text-muted font-semibold">Sudah Dibayar</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Detail_transaksi::where('tempat_id', $id)->where('status', 1)->count() }}
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
                                        <div class="stats-icon red">
                                            <i class="fas fa-check-double"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Sudah Konfirmasi</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Detail_transaksi::where('tempat_id', $id)->where('status', 1)->where('kedatangan', 1)->count() }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <section class="section">

                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content">

                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="order">
                                        <thead>
                                            <tr>
                                                <th></th>

                                                <th scope="col">Nama</th>
                                                <th scope="col">Order_id</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Tiket</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Sub Total</th>
                                                {{-- <th scope="col">Jenis Pembayaran</th> --}}
                                                <th scope="col">Status</th>

                                                <th scope="col"></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($detail) > 0)
                                                @foreach ($detail as $key => $detail)
                                                    <tr>

                                                        <td>
                                                            <br>
                                                        </td>
                                                        <td>
                                                            @if ($detail->usera->name == null)
                                                            @else
                                                                {{ $detail->usera->name }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $detail->kode_tiket }}
                                                        </td>
                                                        <td>
                                                            {{ $detail->tanggal_a }}
                                                        </td>


                                                        <td>
                                                            {{ $detail->name }}
                                                        </td>

                                                        <td>
                                                            {{ $detail->jumlah }}
                                                        </td>
                                                        <td>
                                                            Rp.{{ number_format($detail->harga) }}
                                                        </td>
                                                        <td>
                                                            @if ($detail->status == null)
                                                                <span class="badge bg-danger">Belum Dibayar</span>
                                                            @else
                                                                <span class="badge bg-warning">Sudah Dibayar</span>
                                                                {{-- @if ($detail->kedatangan == '0')
                                                X
                                                @else
                                                V
                                                @endif --}}
                                                            @endif
                                                        </td>
                                                        <td>

                                                            @if ($detail->status == null)
                                                                <i class="fas fa-times"></i>
                                                            @else
                                                                @if ($detail->kedatangan == 1)
                                                                    <i class="fas fa-check-double"></i>
                                                                @else
                                                                    <i class="fas fa-check"></i>
                                                                @endif
                                                            @endif
                                                        </td>


                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>No user to display</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Hoverable rows end -->

        </div>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#order');
            let dataTable = new simpleDatatables.DataTable(table1);
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
