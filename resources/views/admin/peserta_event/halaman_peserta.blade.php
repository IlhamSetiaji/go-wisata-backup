@extends('admin.layouts2.master')
@section('title', 'Daftar Peserta Event')



@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

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
                    <h3>Data Peserta Event</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data peserta event</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Peserta Event</a></li>
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
                                                    class="btn btn-outline-primary me-1 mb-1">Tambah Peserta</button></a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-lg table-hover" id="event">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Kode Booking</th>
                                                <th scope="col">Nama</th>
                                                {{-- <th scope="col">Email</th> --}}
                                                <th scope="col">Tgl Daftar</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Available</th>
                                                <th scope="col" colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($pesertaevent) > 0)
                                                @foreach ($pesertaevent as $key => $pesertaevent)
                                                    <tr>
                                                        <td>
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td>
                                                            {{ $pesertaevent->bookingevent->kode_booking }}
                                                        </td>
                                                        <td>
                                                            {{ $pesertaevent->nama_peserta }}
                                                        </td>
                                                        {{-- <td>
                                                            {{ $pesertaevent->email }}
                                                        </td> --}}
                                                        <td>
                                                            {{ $pesertaevent->created_at }}
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>

                                                        </td>
                                                        {{-- <td>
                                                            <a class="btn btn-primary" type="button"
                                                                href="{{ route('pesertavent.show', [$pesertaevent->id]) }}">Detail</a>
                                                        </td> --}}
                                                        <td>
                                                            <a class="btn btn-danger" type="button"
                                                                href="/pesertaevent/{{ $pesertaevent->id }}/destroy"
                                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>Tidak ada data peserta event</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Basic Modal -->
            <div class="modal fade text-left" id="create" tabindex="-1" aria-labelledby="myModalLabel1"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Tambah Pesert Event</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form form-horizontal" action="{{ route('pesertaevent.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <?php
                                        $data = App\Models\PesertaEvent::max('kode_peserta');
                                        $huruf = 'PE';
                                        $urutan = (int) substr($data, 3, 3);
                                        $urutan++;
                                        $kode_peserta = $huruf . sprintf('%04s', $urutan);
                                        ?>
                                        <div class="col-md-4">
                                            <label>Kode</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative"><input type="text" hidden name="kode_peserta"
                                                        value="{{ $kode_peserta }}">
                                                    {{ $kode_peserta }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Booking ID</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <select name="bookingevent_id" class="selectpicker form-select" required
                                                    aria-label=".form-select-sm example" data-live-search="true">
                                                    @foreach ($bookingevent as $be)
                                                        <option value="{{ $be->id }}">
                                                            {{ $be->kode_booking }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama Peserta</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text"
                                                        class="form-control @error('nama_peserta') is-invalid @enderror"
                                                        name="nama_peserta" id="first-name-icon"
                                                        value="{{ old('nama_peserta') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Usia</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number"
                                                        class="form-control @error('usia') is-invalid @enderror" name="usia"
                                                        id="first-name-icon" value="{{ old('usia') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="radio" name="jk" value="Laki-laki"> Laki-laki<br>
                                                    <input type="radio" name="jk" value="Perempuan"> Perempuan<br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="first-name-icon" value="{{ old('email') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telepon</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                                    name="telp" id="first-name-icon" value="{{ old('telp') }}" required>
                                            </div>
                                            <div class="position-relative">
                                                <input type="hidden" name="user_id" class="form-control"
                                                    value="{{ auth()->user()->id }}">
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

        </div>
        <script></script>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            let table1 = document.querySelector('#event');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> --}}
        <script type="text/javascript">
            var rupiah = document.getElementById('rupiah');
            rupiah.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>
        <script type="text/javascript">
            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();


                function cb(start, end) {
                    $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#daterange').daterangepicker({
                    format: 'YYYY-MM-DD',
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],

                        'This Month': [moment().startOf('month'), moment().endOf('month')],

                    }
                }, cb);

                cb(start, end);
                $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

            });
        </script>
    @endsection
