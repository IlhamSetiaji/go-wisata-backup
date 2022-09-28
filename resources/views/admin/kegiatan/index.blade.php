@extends('admin.layouts2.master')
@section('title', 'Daftar Kegiatan')



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

   {{-- message toastr --}}
   <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
   <script src="{{asset('assets/js/toastr.min.js')}}"></script>

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kegiatan</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Kegiatan </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Kegiatan</a></li>
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
                    {{-- <div class="card-header">

                        <a href="{{route('Kegiatan.create')}}" class="btn bt-info"><i class="fas fa-user-plus"></i> </a>



                    </div> --}}
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-right">
                                <li class="breadcrumb-item">    <a href="{{route('kegiatan.create')}}" class="btn btn-outline-primary ">Tambah Kegiatan </a></li>

                            </ol>
                        </nav>




                    </div>
                    <div class="card-content">

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-lg table-hover" id="Kegiatan">
                                <thead>
                                    <tr >


                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Available</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($kegiatans)>0)
                                    @foreach($kegiatans as $key=>$kegiatan)
                                    <tr>
                                           <td>
                                            {{$key+1}}

                                        </td>

                                        <td>
                                            {{ $kegiatan->name }}
                                        </td>
                                        <td>
                                            @if($kegiatan->image == null)
                                            <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/hal.png">
                                            @else
                                            <div class="avatar avatar-xl">
                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$kegiatan->image}}">
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <?php
                                            $tgl_a = date('d F Y',  strtotime($kegiatan->date_a));
                                            $tgl_b = date('d F Y',  strtotime($kegiatan->date_b));
                                           ?>
                                           {{ $tgl_a }} - {{ $tgl_b }}
                                        </td>
                                        <td>
                                            @if($kegiatan->status==0)
                                            <a href="{{route('update.status.kegiatan',[$kegiatan->id])}}"><button class="btn btn-danger"> Inactive</button></a>
                                            @else
                                            <a href="{{route('update.status.kegiatan',[$kegiatan->id])}}"><button class="btn btn-warning"> Active</button></a>
                                            @endif



                                        </td>
                                        <td>
                                             @if($kegiatan->kapasitas_b >= $kegiatan->kapasitas)
                                             <button class="btn btn-primary"> Full</button>

                                             @else
                                             <?php
                                             $sisa = (int)($kegiatan->kapasitas) - (int)($kegiatan->kapasitas_b);
                                             ?>
                                             Ya, {{ $kegiatan->kapasitas_b }}/{{ $kegiatan->kapasitas }}
                                             @endif

                                        </td>
                                        <td>
                                       <a href="{{route('kegiatan.show',[$kegiatan->id])}}" class="btn btn-info rounded-pill">Detail</a>
                                       {{-- <a href="#" class="btn btn-secondary rounded-pill">Edit</a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <td>Tidak ada kegiatan</td>
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
<script>






</script>
<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
<script>
    // Simple Datatable
    let table1 = document.querySelector('#Kegiatan');
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
