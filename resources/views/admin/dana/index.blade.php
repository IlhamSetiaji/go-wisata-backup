@extends('admin.layouts2.master')
@section('title','Pengajuan Dana')
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

<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pengajuan Pencairan</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Pengajuan Pencairan Dana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dana</a></li>
                        <li class="breadcrumb-item active" aria-current="page">index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
{!! Toastr::message() !!}


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Belum Diproses</h4>
</div>
        <div class="card-content">
            <div class="card-body">

              <table class="table table-hover" id="tempat">
                <thead>
                    <tr >


                        <th scope="col">Name</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Jumlah</th>
                        {{-- <th scope="col">Guest</th> --}}
                        {{-- <th scope="col">Status</th> --}}
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody
                @foreach ($cair as $data)
                <tr>
                    <td class="col-3">{{  $data->petugas->name }}</td>
                    <td class="col-3 "> x {{ $data->tempat->name}}</td>

                    <td class="col-2"> Rp. {{ number_format($data->jumlah) }}</td>


                    </td>
                    <td class="col-6 ">
                        @if($data->status == "0")
                        <a href="{{route('penolakan.dana',[$data->id])}}"><button class="btn btn-danger"> Tolak </button></a>

                        <a href="{{route('konfirmasi.dana',[$data->id])}}"><button class="btn btn-warning"> Konfirmasi </button></a>
                        @else
                        Disetujui
                        @endif
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                     <h4> Riwayat Pengajuan</h4>
         </div>
        <div class="card-content">
            <div class="card-body">

              <table class="table table-hover" id="tempat2">
                <thead>
                    <tr >


                        <th scope="col">Name</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Jumlah</th>
                        {{-- <th scope="col">Guest</th> --}}
                        {{-- <th scope="col">Status</th> --}}
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody
                @foreach ($cair2 as $data)
                <tr>
                    <td class="col-3">{{  $data->petugas->name }}</td>
                    <td class="col-3 "> x {{ $data->tempat->name}}</td>

                    <td class="col-2"> Rp. {{ number_format($data->jumlah) }}</td>


                    </td>
                    <td class="col-6 ">
                        @if($data->status == "0")
                        @elseif($data->status == "1")
                        Disetujui
                        @else
                        Ditolak
                        @endif
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
<script>
    // Simple Datatable
    let table1 = document.querySelector('#tempat');
    let dataTable = new simpleDatatables.DataTable(table1);

</script>
<script>
let table2 = document.querySelector('#tempat2');
    let dataTable2 = new simpleDatatables.DataTable(table2);
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
