@extends('admin.layouts2.master')
@section('title','Dana')
@section('content')
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
                <h3>Data Dana</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Dana</p>
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
<div class="row">
<div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">


                        <div class="stats-icon blue">
                            <i class="fas fa-dollar-sign"></i>
                            {{-- <i class="fas fa-dollar-sign"></i> --}}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Dana Utama</h6>
                        <h6 class="font-extrabold mb-0">Rp. {{ number_format(  $uangutama )}} </h6>
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
                        <i class="fas fa-arrow-down"></i>

                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold">Dana Masuk</h6>
                    <h6 class="font-extrabold mb-0">Rp. {{ number_format( $duit) }} </h6>
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
                        {{-- <i class="fas fa-dollar-sign"></i> --}}
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold"> Menunggu </h6>
                    <h6 class="font-extrabold mb-0">Rp. {{number_format($duit3) }}</h6>
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


                    <div class="stats-icon purple">
                        {{-- <i class="fas fa-dollar-sign"></i> --}}
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold"> Dana Keluar</h6>
                    <h6 class="font-extrabold mb-0">Rp. {{number_format($duit2) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 <!-- list group button & badge start-->
 <section class="list-group-button-badge">
    <div class="row match-height">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pemasukan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <table class="table table-borderless">
                        @foreach ($data as $data)
                        <tr>
                            <td class="col-5">{{  $data->name  }}</td>
                            <td class="col-3 "> x {{ $data->jumlah }}</td>

                            <td class="col-4 "> Rp. {{ number_format($data->harga) }}</td>
                            <td class="col-2">
                                @if ($data
                                ->status == null)
                                <i class="fas fa-times"></i>
                                @else
                                @if ($data->kedatangan == 1)
                                <i class="fas fa-check-double"></i>
                                @else
                                <i class="fas fa-check"></i>

                                @endif
                                @endif


                            </td>
                            {{-- <td class="col-5 text-center"> x {{ $data->jumlah }}</td> --}}

                        </tr>
                        @endforeach

                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pencairan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p>
                        </p>
                        <form action="{{ route('danak.cair') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tempat_id"  value="{{  $id_tempat }}">
                            <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}">
                            <input  name="jumlah" class="form-control" type="text" id="rupiah" placeholder="Jumlah Uang" required>
                            <br>
                                <button  class="btn btn-outline-primary" type="sumbit">
                                    Ajukan
                                </button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Histori Pencairan</h4>
            </div>
            <div class="card-content">
                <div class="card-body">

                <table class="table table-borderless" id="tempat">
                    @foreach ($cair as $data)
                    <tr>
                        <td class="col-3">{{  $data->petugas->name }}</td>
                        <td class="col-3 "> x {{ $data->tempat->name}}</td>

                        <td class="col-3 "> Rp. {{ number_format($data->jumlah) }}</td>
                        <td class="col-3"> {{ $data->created_at }}

                        </td>
                        <td class="col-5 text-center">
                            @if($data->status == "0")
                            Menunggu
                            @elseif ($data->status == 2)
                            Ditolak
                            @else
                            Disetujui
                            @endif
                        </td>

                    </tr>
                    @endforeach

                </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- list group button & badge ends -->
<script type="text/javascript">

    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
<script>
    // Simple Datatable
    let table1 = document.querySelector('#tempat');
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
