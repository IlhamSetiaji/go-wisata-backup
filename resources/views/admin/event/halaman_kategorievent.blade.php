@extends('admin.layouts2.master')
@section('title', 'Daftar Kategori Event')



@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
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
                    <h3>Data Kategori Event</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data kategori event</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Kategori Event</a></li>
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
                                        <li class="breadcrumb-item">
                                            <a data-bs-toggle="modal" data-bs-target="#create"> <button
                                                    class="btn btn-outline-primary me-1 mb-1">Tambah Kategori</button></a>
                                        </li>

                                    </ol>
                                </nav>
                            </div>
                            <div class="card-content">
                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-lg table-hover" id="Kegiatan">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Jumlah Event</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($kategorievent) > 0)
                                                @foreach ($kategorievent as $key => $ke)
                                                    @php
                                                        $dataevent = App\Models\Event::where('kategorievent_id', $ke->id)->count();
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td>
                                                            {{ $ke->nama_kategori }}
                                                        </td>
                                                        <td>
                                                            {{ $dataevent }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#ModalEdit{{ $ke->id }}">Edit</a>
                                                            <a href="/kategorievent/{{ $ke->id }}/delete"
                                                                onclick="return confirm('Yakin ingin menghapus?')"><button
                                                                    class="btn btn-danger">Hapus</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>Tidak ada data kategori event</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Tambah-->
            <div class="card-body">
                <div class="modal fade text-left" id="create" tabindex="-1" aria-labelledby="myModalLabel1"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Tambah Kategori</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal" action="/kategorievent/create" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Kategori</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('nama_kategori') is-invalid @enderror"
                                                            name="nama_kategori">
                                                        @error('nama_kategori')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary me-1 mb-1">Tambah</button>
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($kategorievent as $ke)
                <div class="modal fade text-left" id="ModalEdit{{ $ke->id }}" tabindex="-1"
                    aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Edit Kategori</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal" action="/kategorievent/{{ $ke->id }}/update"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Kategori</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('nama_kategori') is-invalid @enderror"
                                                            name="nama_kategori" value="{{ $ke->nama_kategori }}">
                                                        @error('nama_kategori')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class=" modal-footer">
                                <button type="submit" class="btn btn-outline-primary me-1 mb-1">Edit</button>
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <script></script>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
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
