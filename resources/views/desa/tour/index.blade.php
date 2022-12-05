@extends('admin.layouts2.master')
@section('title', 'Daftar Tour Guide')



@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/dripicons/webfont.css')}}"> --}}

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
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
                    <h3>Data Tour Guide</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data tour guide</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Tour Guide</a></li>
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
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-right">
                                        <li class="breadcrumb-item"> <a href="{{ route('tourd.show') }}"
                                                class="btn btn-outline-primary ">Tambah Tour Guide </a></li>

                                    </ol>
                                </nav>

                            </div>
                            <div class="card-content">

                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="admin">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telfon</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Desa Penugasan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (count($tour) > 0)
                                                @foreach ($tour as $tour)
                                                    <tr>
                                                        <td></td>

                                                        <td>
                                                            {{ $tour->id }}
                                                        </td>
                                                        <td>
                                                            {{ $tour->name }}
                                                        </td>
                                                        <td>
                                                            @if ($tour->foto == null)
                                                                <img alt="image" class="mr-3 rounded-circle"
                                                                    width="50" src="{{ asset('images') }}/user.png">
                                                            @else
                                                                <div class="avatar avatar-xl">
                                                                    <img alt="image" class="mr-3 rounded-circle"
                                                                        width="50"
                                                                        src="{{ asset('images') }}/{{ $tour->foto }}">
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $tour->email }}
                                                        </td>
                                                        <td>
                                                            {{ $tour->telp }}
                                                        </td>
                                                        <td>
                                                            {{ $tour->harga }}
                                                        </td>
                                                        <td>
                                                            {{ $tour->nama_desa }}
                                                        </td>
                                                        <td>
                                                            @if ($tour->status == 1)
                                                                Aktif
                                                            @else
                                                                Tidak Aktif
                                                            @endif
                                                        </td>
                                                        <td class="row">
                                                            <a href="{{ route('tourd.edit', [$tour->id]) }}"
                                                                class="col">
                                                                <span class="btn bt-success"><i
                                                                        class="bi bi-pencil-square"></i></span>
                                                            </a>
                                                            <form action="{{ route('tourd.updatestatus') }}"
                                                                method="POST">
                                                                @csrf
                                                                @if ($tour->status == 1)
                                                                    <input type="text" name="id"
                                                                        value="{{ $tour->id }}" hidden>
                                                                    <input type="text" name="status" id="status"
                                                                        value="0" hidden>
                                                                    <button
                                                                        class="btn btn-secondary mb-1 btn-sm">Nonaktifkan</button>
                                                                @else
                                                                    <input type="text" name="id"
                                                                        value="{{ $tour->id }}" hidden>
                                                                    <input type="text" name="status" id="status"
                                                                        value="1" hidden>
                                                                    <button
                                                                        class="btn btn-info mb-1 btn-sm">Aktifkan</button>
                                                                @endif
                                                            </form>
                                                            {{-- <a class="col">
                                            <form class="forms-sample" action="{{route('tourd.destroy',[$tour->id])}}" method="post" >
                                                @csrf
                                                @method('POST')
                                                    <button type="submit" class="btn bt-danger" onclick="return confirm('Are you sure to want to delete it?')"><i class="bi bi-trash"></i></span> </button>
                                            </form>
                                            </a> --}}
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
        <script></script>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#admin');
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
