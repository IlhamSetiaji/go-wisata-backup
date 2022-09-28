@extends('admin.layouts2.master')
@section('title', 'Daftar Tempat')



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
                <h3>Data Tempat</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Tempat</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Tempat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="page-content">
    {!! Toastr::message() !!}
    <section class="section">

        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-right">
                                <li class="breadcrumb-item">    <a href="{{route('tempat.created')}}" class="btn btn-outline-primary ">Tambah Tempat </a></li>

                            </ol>
                        </nav>




                    </div>
                    <div class="card-content">

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="tempat">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">No</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Petugas</th>
                                        <th scope="col">Dana</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($tempatk)>0)
                                    @foreach($tempatk as $key=>$users)
                                    <tr>
                                        <td></td>
                                        <td>
                                            {{$key+1}}

                                        </td>
                                        <td>
                                            <div class="avatar avatar-xl">
                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$users->image}}">
                                            </div>
                                        </td>
                                        <td>
                                            {{ $users->name }}
                                        </td>
                                        <td>
                                            {{ $users->kategori}}
                                        </td>

                                        <td>
                                            @if($users->petugas== null)


                                            Eror
                                            @else

                                            {{ $users->petugas->name}}
                                            @endif
                                        </td>
                                        <td>
                                            Rp. {{  number_format($users->dana) }}
                                        </td>
                                         <td>
                                            @if($users->status==1)
                                            <a href="{{route('update.status.tempatd',[$users->id])}}"><button class="btn btn-warning"> Active</button></a>
                                            @else
                                            <a href="{{route('update.status.tempatd',[$users->id])}}"><button class="btn btn-danger"> Inactive</button></a>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if($users->status==1)
                                            <span class="badge bg-warning">Active</span></td>
                                            @else
                                            <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <a href="{{route('tempat.editd',[$users->id])}}">
                                                <span class="btn bt-success"><i class="bi bi-pencil-square"></i></span>
                                            </a>
                                        </td>


                                    </tr>
                                    @endforeach

                                    @else
                                    <td>No Data to display</td>
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
