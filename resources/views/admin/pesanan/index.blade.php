@extends('admin.layouts2.master')
@section('title', 'Admin Page')
{{-- @section('page', 'Dashboard ') --}}


@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/dripicons/webfont.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>



<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pesanan</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Pesanan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {!! Toastr::message() !!}
    <div class="page-content">
        <section class="section">

            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">



                        </div>
                        <div class="card-content">

                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="pelanggan">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Kode</th>
                                            {{-- <th scope="col">Tempat</th> --}}
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($tiket)>0)
                                        @foreach($tiket as $key=>$tiket)
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                {{$key+1}}

                                            </td>

                                            <td>
                                                {{ $tiket->order_id }}
                                            </td>
                                            {{-- <td>
                                                {{ $tiket->tempat->name}}
                                            </td> --}}

                                            <td>
                                                @foreach(App\Models\Tiket::where('kode',$tiket->kodeku)->get() as $cust)
                                                @if($cust->customer == null)
                                                @else

                                                {{ $cust->customer->name }}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($tiket->tiketnya == null)
                                                @else
                                                {{ $tiket->tiketnya->harga }}
                                                @endif
                                            </td>

                                            <td>
                                                @if ( $tiket->status_message == "settlement")
                                                <button class="btn btn-primary">&nbsp;&nbsp;Berhasil Dibayar&nbsp;&nbsp;&nbsp;</button>
                                                @elseif ( $tiket->status_message =="pending")
                                                <button class="btn btn-info">Menunggu Dibayar</button>
                                                @elseif ( $tiket->status_message == null)
                                                {{-- <button class="btn btn-warning ">Pilih pembayaran</button> --}}
                                                @elseif ( $tiket->status_message == "expire")
                                                <button class="btn btn-danger">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Expire&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</button>
                                                @elseif ( $tiket->status_message == "cancel")
                                                <button class="btn btn-danger">&nbsp;&nbsp; &nbsp;  &nbsp;Dibatalkan&nbsp; &nbsp; &nbsp;&nbsp;</button>
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



    <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
    {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#pelanggan');
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
