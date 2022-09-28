@extends('admin.layouts2.master')
@section('title','History Top Up')
@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Top Up Pelanggan</h3>
                <p class="text-subtitle text-muted">Halaman untuk pengecekan data Top Up</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Top Up</a></li>
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
                                    <h6 class="text-muted font-semibold">Total Top Up</h6>
                                    <h6 class="font-extrabold mb-0">{{App\Models\TopUp::count()}}</h6>
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
                                    <h6 class="font-extrabold mb-0">{{App\Models\TopUp::where('keterangan','Pembayaran Sedang Diproses, Silahkan Menunggu Email Sukses Pembayaran')->count()}}</h6>
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
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    {{-- <h6 class="text-muted font-semibold">Sudah Dibayar tapi belum datang</h6> --}}
                                    <h6 class="text-muted font-semibold">Sudah Dibayar</h6>
                                    <h6 class="font-extrabold mb-0">{{App\Models\TopUp::where('keterangan','Sudah Terbayar, Saldo Sudah Ditambahkan')->count()}}</h6>
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
                                    <div class="stats-icon red">
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Sudah Konfirmasi</h6>
                                    <h6 class="font-extrabold mb-0">{{App\Models\Detail_transaksi::where('tempat_id', $id)->where('status',1)->where('kedatangan',1)->count()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

    </section>

    <section class="section">

        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content">

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="topup">
                                <thead>
                                    <tr >
                                        <th>No</th>

                                        {{-- <th scope="col">Nama</th> --}}
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kode Unik</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Nominal ditransfer</th>
                                        {{-- <th scope="col">Keterangan</th> --}}
                                        {{-- <th scope="col">Jenis Pembayaran</th> --}}
                                        {{-- <th scope="col">Status</th> --}}

                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($historis)>0)
                                    @foreach($historis as $key=>$history)
                                    <tr>

                                        <td>
                                            {{ $key+=1 }}
                                        </td>
                                        <td>
                                            {{ $history->name }}
                                        </td>
                                        <td>
                                            {{ $history->kode_unik}}
                                        </td>


                                        <td>
                                            Rp.{{ number_format($history->nominal) }}
                                        </td>

                                        <td>
                                            Rp.{{ number_format($history->nominal_ditransfer) }}
                                        </td>
                                        <td>
                                            {{-- {{ $history->keterangan }} --}}
                                            @if ($history->keterangan == null)
                                            <i class="fas fa-times"></i>
                                            @else
                                            {{-- @if ($history->keterangan == )
                                            <i class="fas fa-check-double"></i> --}}
                                            @if ($history->keterangan == 'Sudah Terbayar, Saldo Sudah Ditambahkan')
                                            <i class="fas fa-check-double"></i>
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
<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
<script>
    // Simple Datatable
    let table1 = document.querySelector('#topup');
    let dataTable = new simpleDatatables.DataTable(table1);


</script>
{{-- <script type="text/javascript">

    $(document).ready(function () {
        $('#order').DataTable({
            dom: 'Blftip',

            buttons: [

                     {
                         extend: 'copy',
                         class:'btn btn-primary',

                         text: '<i class="far fa-copy"></i> Copy'
                     },
                     {
                         extend: 'excel',

                         text: '<i class="far fa-file-excel"></i> Excel', title: 'Rekap Excel'
                     },
                     {
                         extend: 'pdf',

                         text: '<i class="far fa-file-pdf"></i> Pdf', title: 'Rekap PDF'
                     },
                     {
                         extend: 'csv',

                         text: '<i class="fas fa-file-csv"></i> CSV', title: 'Rekap CSV'
                     },
                     {
                         extend: 'print',

                         text: '<i class="fas fa-print"></i> Print'
                     }
                 ]
        });
    });
</script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
@endsection
