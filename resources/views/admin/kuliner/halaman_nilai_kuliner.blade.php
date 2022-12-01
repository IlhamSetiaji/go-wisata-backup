@extends('admin.layouts2.master')
@section('title', 'Review Kuliner')



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
                    <h3>Data Review Kuliner</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola komentar/ulasan mengenai kuliner </p>
                </div>
            </div>
        </div>
        {!! Toastr::message() !!}
        <div class="page-content">
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-lg table-hover" id="kuliner">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Rating</th>
                                                {{-- <th scope="col">Kuliner</th> --}}
                                                <th scope="col" colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($reviewk) > 0)
                                                @foreach ($reviewk as $key => $n)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $n->user->name }}</td>
                                                        <td>{{ $n->rating }}</td>
                                                        {{-- <td>{{ $n->kuliner->comment}}</td> --}}
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#detail{{ $r->id }}"> <i
                                                                    class="fa fa-eye"></i></a>
                                                            <!--Basic Modal -->
                                                            <div class="modal fade text-left" id="detail{{ $r->id }}"
                                                                tabindex="-1" aria-labelledby="myModalLabel1"
                                                                style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel1">
                                                                                Detail Review</h5>
                                                                            <button type="button"
                                                                                class="close rounded-pill"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <i data-feather="x"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <label>Rating</label>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-group ">
                                                                                            <div class="position-relative">
                                                                                                {{ $n->rating }}/5
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label>Review</label>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-group ">
                                                                                            <div align="justify"
                                                                                                class="position-relative">
                                                                                                {{ $n->comment }}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-primary ml-1"
                                                                                    data-bs-dismiss="modal">
                                                                                    <i
                                                                                        class="bx bx-check d-block d-sm-none"></i>
                                                                                    <span
                                                                                        class="d-none d-sm-block">Close</span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a type="button" class="btn bt-danger"
                                                                href="/reviewkuliner/hapus"
                                                                onclick="return confirm('Yakin ingin menghapus?')"><i
                                                                    class="bi bi-trash"></i></span> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>Tidak ada data review</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- <a class=" nav-link" href="{{ url('/akuliner/reviewkuliner') }}"><i class="fas fa-gamepad"></i><span> Kembali</span></a> --}}
        </div>
    </div>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        let table1 = document.querySelector('#kuliner');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endsection
