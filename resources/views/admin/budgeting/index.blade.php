@extends('admin.layouts2.master')
@section('title', 'Daftar Paket')



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
                    <h3>Data Paket</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data paket</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('budget.index') }}">Budget</a></li>
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

                        <a href="{{route('admin.create')}}" class="btn bt-info"><i class="fas fa-user-plus"></i> </a>



                    </div> --}}
                            <div class="card-header">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-right">
                                        <li class="breadcrumb-item"> <a href="{{ route('budget.create') }}"
                                                class="btn btn-outline-primary ">Tambah Paket </a></li>

                                    </ol>
                                </nav>




                            </div>
                            <div class="card-content">

                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="admin">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Paket</th>
                                                <th scope="col">Jumlah Orang</th>
                                                <th scope="col">Jumlah Hari</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pakets as $paket)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $paket->nama_paket }}</td>
                                                    <td>{{ $paket->jml_orang }}</td>
                                                    <td>{{ $paket->jml_hari }}</td>
                                                    @if ($paket->status == 1)
                                                        <td>Aktif</td>
                                                    @else
                                                        <td>Tidak Aktif</td>
                                                    @endif
                                                    <td>{{ $paket->harga }}</td>
                                                    <td>
                                                        <form action="{{ route('update-status') }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @if ($paket->status == 1)
                                                                <input type="text" name="id"
                                                                    value="{{ $paket->id }}" hidden>
                                                                <input type="text" name="status" id="status"
                                                                    value="0" hidden>
                                                                <button class="btn btn-secondary mb-1">Nonaktifkan</button>
                                                            @else
                                                                <input type="text" name="id"
                                                                    value="{{ $paket->id }}" hidden>
                                                                <input type="text" name="status" id="status"
                                                                    value="1" hidden>
                                                                <button class="btn btn-success mb-1">Aktifkan</button>
                                                            @endif
                                                        </form>
                                                        {{-- <input type="text" id="id_paket" value="{{ $paket->id }}" --}}
                                                        {{-- hidden> --}}
                                                        <button class="btn btn-warning mb-1">Edit</button>
                                                        <button id="detail" class="btn btn-info"data-bs-toggle="modal"
                                                            data-bs-target="#modal-detail" data-id="{{ $paket->id }}"
                                                            data-nama="{{ $paket->nama_paket }}"
                                                            data-orang="{{ $paket->jml_orang }}"
                                                            data-status="{{ $paket->status }}"
                                                            data-harga="{{ $paket->harga }}"
                                                            data-hari="{{ $paket->jml_hari }}">Detail</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Hoverable rows end -->
            <div class="modal fade" id="modal-detail" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Paket</h5>
                            <button type="button" class="btn-close" id="close-budgeting" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="budget">
                            <div class="mb-3">
                                <label for="" class="form-label">Name Paket</label>
                                <input type="text" id="nama-paket" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Jumlah Orang</label>
                                <input type="text" id="jml_orang" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Jumlah Hari</label>
                                <input type="text" id="jml_hari" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <input type="text" id="status_budget" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Harga</label>
                                <input type="text" id="harga_budget" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" id="close-budgeting" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script></script>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
        <script>
            $(document).ready(function() {
                $(document).on('click', '#detail', function() {
                    var nama_paket = $(this).data('nama');
                    var jml_orang = $(this).data('orang');
                    var jml_hari = $(this).data('hari');
                    var status = $(this).data('status');
                    var harga = $(this).data('harga');
                    var id = $(this).data('id_paket1');
                    $('#nama-paket').val(nama_paket);
                    $('#jml_orang').val(jml_orang);
                    $('#jml_hari').val(jml_hari);
                    if (status == 1) {
                        $('#status_budget').val("Aktif");
                    } else {
                        $('#status_budget').val("Tidak Aktif");
                    }
                    $('#harga_budget').val(harga);
                });
            });
            // // Simple Datatable
            let table1 = document.querySelector('#admin');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
        <script>
            $(document).ready(function() {
                $(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                });


                $('#detail').on('click', function() {
                    let id = $(this).data('id');;
                    console.log(id);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-data-paket') }}",
                        data: {
                            paket_id: id
                        },
                        cache: false,

                        success: function(msg) {
                            console.log(msg);
                            $('#budget').append(msg);
                        },
                        error: function(data) {
                            console.log('error: ', data)
                        }
                    });
                    $('#close-budgeting').on('click', function() {
                        id = '';
                    });
                })
            });
        </script>
        <script>
            // $(document).ready(function() {
            //     $(function() {
            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             }
            //         });
            //     });

            //     $('#detail').on('click', function() {
            //         let id = $(this).attr('data-id');

            //         $.ajax({
            //             type: 'POST',
            //             url: "{{ route('get-data-paket') }}",
            //             data: {
            //                 paket_id: id
            //             },
            //             cache: false,

            //             success: function(msg) {
            //                 $('.modal-body').html(msg)
            //                 // id = '';
            //                 $('#modal-detail').modal('show');
            //             },
            //             error: function(data) {
            //                 console.log('error: ', data)
            //             }
            //         });
            //     })
            // });
            // $(function() {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            //     $(function() {
            //         $('#detail').on('click', function() {
            //             let id = $(this).attr('data-id');

            //             $.ajax({
            //                 type: 'POST',
            //                 url: "{{ route('get-data-paket') }}",
            //                 data: {
            //                     paket_id: id
            //                 },
            //                 cache: false,

            //                 success: function(msg) {
            //                     $('.modal-body').html(msg)
            //                     // id = '';
            //                     $('#modal-detail').modal('show');
            //                 },
            //                 error: function(data) {
            //                     console.log('error: ', data)
            //                 }
            //             });
            //         })
            //     })
            // });
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
