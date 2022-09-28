@extends('pesanan.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <body>
        <div class="container">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <form
                        action="/pesan/villa/{{ $villa->id }}/{{ $checkin }}/{{ $checkout }}/{{ $durasi }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fa fa-id-card-o"></i> Data Pemesan
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Nama *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="nama"
                                                            id="first-name-icon" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>No Telepon *</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="number" class="form-control" name="telp"
                                                            id="first-name-icon" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah orang *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <input type="number"
                                                        class="form-control @error('jml_orang') is-invalid @enderror"
                                                        name="jml_orang" id="first-name-icon" value="{{ old('jml_orang') }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>No Identitas (NIK) *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input
                                                            class="form-control @error('kartu_identitas') is-invalid @enderror"
                                                            name="kartu_identitas" type="number" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person-square"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"
                            onclick=" return confirm('Yakin ingin pesan?')">Pesan</button>
                    </form>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pesanan</h4>
                        </div>
                        <div class="card-content pb-4">
                            <div class="recent-message d-flex px-4 py-3">
                                <p>Nama Tempat : {{ $villa->nama }}</br>
                                    Harga : Rp.{{ number_format($villa->harga) }} / night </br>
                                    Durasi : {{ $durasi }} night </br>
                                    Total : Rp.{{ number_format($villa->harga * $durasi) }} </br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#pesan');
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
