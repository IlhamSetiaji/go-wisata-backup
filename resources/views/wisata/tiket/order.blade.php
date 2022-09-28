@extends('admin.layouts2.master')
@section('title','Order')
@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
--}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script> 

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

<div class="col-12 col-md-6 col-lg-6 mb-5">
    <form action="/awisata/order" method="post">
        @csrf
        <div class="form-group">
            <h6>Range Waktu</h6>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="daterange" name="daterange" />
                <button class="btn btn-success" type="submit" name="submit" value="table">Search</button>
                {{-- <button class="btn btn-primary" type="submit" name="submit" value="download">Export All</button> --}}
            </div>
        </div>
    </form>
</div>

@if (@isset($detail))
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
                                    <h6 class="font-extrabold mb-0">Rp. {{number_format($total)}}</h6>
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
                                    <h6 class="font-extrabold mb-0">Rp. {{number_format($belum_bayar)}}</h6>
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
                                    <h6 class="font-extrabold mb-0">Rp. {{number_format($bayar)}}</h6>
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
                                    <h6 class="font-extrabold mb-0">Rp. {{number_format($konfirm)}}</h6>
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
                                    <tr >
                                        <th>No</th>

                                        {{-- <th scope="col">Nama</th> --}}
                                        <th scope="col">Nama</th>
                                        <th scope="col">Order_id</th>
                                        <th scope="col">Tiket</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Jenis Pembayaran</th>
                                        {{-- <th scope="col">Status</th> --}}

                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($detail)>0)
                                    @foreach($detail as $key=>$detail)
                                    <tr>

                                        <td>
                                            {{ $key+=1 }}
                                        </td>
                                        <td>
                                            @if($detail->usera->name == null)
                                            @else
                                            {{ $detail->usera->name }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $detail->kode_tiket}}
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
                                            {{ $detail->type_bayar }}
                                        </td>
                                        
                                        <td>
                                            @if ($detail->status == null)
                                            <i class="fas fa-times"></i>
                                            @else
                                            @if ($detail->kedatangan == 1)
                                            <i class="fas fa-check-double"></i>
                                            @elseif ($detail->kedatangan == 0 && $detail->type_bayar =='Bayar Langsung')
                                            <i class="fas fa-times"></i>
                                            @elseif ($detail->kedatangan == 1 && $detail->type_bayar == 'Bayar Langsung')
                                            <i class="fas fa-check-double"></i>
                                            @elseif ($detail->kedatangan == 1 && $detail->type_bayar == 'Epay')
                                            <i class="fas fa-check-double"></i>
                                            @elseif ($detail->status == 1)
                                            <i class="fas fa-check"></i>
                                            @else
                                            <i class="fas fa-times"></i>
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

@else
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
                            <h6 class="font-extrabold mb-0">Rp. {{number_format(App\Models\Detail_transaksi::sum('harga'))}}</h6>
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
                            <h6 class="font-extrabold mb-0">Rp. {{number_format(App\Models\Detail_transaksi::where('status', NULL)->sum('harga'))}}</h6>
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
                            <h6 class="font-extrabold mb-0">Rp. {{number_format(App\Models\Detail_transaksi::where('status', 1)->sum('harga'))}}</h6>
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
                            <h6 class="font-extrabold mb-0">Rp. {{number_format(App\Models\Detail_transaksi::where('status', 1)->where('kedatangan', 1)->sum('harga'))}}</h6>
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
                                <tr >
                                    <th>No</th>

                                    {{-- <th scope="col">Nama</th> --}}
                                    <th scope="col">Nama</th>
                                    <th scope="col">Order_id</th>
                                    <th scope="col">Tiket</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Jenis Pembayaran</th>
                                    {{-- <th scope="col">Status</th> --}}

                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(count($detail2)>0)
                                @foreach($detail2 as $key=>$detail2)
                                <tr>

                                    <td>
                                        {{ $key+=1 }}
                                    </td>
                                    <td>
                                        @if($detail2->usera->name == null)
                                        @else
                                        {{ $detail2->usera->name }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $detail2->kode_tiket}}
                                    </td>


                                    <td>
                                        {{ $detail2->name }}
                                    </td>

                                    <td>
                                        {{ $detail2->jumlah }}
                                    </td>
                                    <td>
                                        Rp.{{ number_format($detail2->harga) }}
                                    </td>
                                    <td>
                                        {{ $detail2->type_bayar }}
                                    </td>
                                    
                                    <td>
                                        @if ($detail2->status == null)
                                        <i class="fas fa-times"></i>
                                        @else
                                        @if ($detail2->kedatangan == 1)
                                        <i class="fas fa-check-double"></i>
                                        @elseif ($detail2->kedatangan == 0 && $detail2->type_bayar =='Bayar Langsung')
                                        <i class="fas fa-times"></i>
                                        @elseif ($detail2->kedatangan == 1 && $detail2->type_bayar == 'Bayar Langsung')
                                        <i class="fas fa-check-double"></i>
                                        @elseif ($detail2->kedatangan == 1 && $detail2->type_bayar == 'Epay')
                                        <i class="fas fa-check-double"></i>
                                        @elseif ($detail2->status == 1)
                                        <i class="fas fa-check"></i>
                                        @else
                                        <i class="fas fa-times"></i>
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
@endif
<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
<script>
    // Simple Datatable
    let table1 = document.querySelector('#order');
    let dataTable = new simpleDatatables.DataTable(table1);


</script>

<script type="text/javascript">
    $(function () {

        var start = moment().subtract(29, 'days');
        var end = moment();


        function cb(start, end) {
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#daterange').daterangepicker({
            format: 'YYYY-MM-DD',
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
        $('#daterange').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD'));
        });
    });

</script>

<script src="{{url('vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{url('vendor/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
@endsection
