@extends('admin.layouts2.master')
@section('title', 'Daftar Villa')



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
                    <h3>Data Villa</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data villa</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Villa</a></li>
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
                                                    class="btn btn-outline-primary me-1 mb-1">Tambah Villa</button></a>
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
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($villa) > 0)
                                                @foreach ($villa as $key => $villa)
                                                    <tr>
                                                        <td>
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td>
                                                            {{ $villa->nama }}
                                                        </td>
                                                        <td>
                                                            @if ($villa->foto == null)
                                                                <img alt="image" class="mr-3 rounded-circle"
                                                                    width="50" src="{{ asset('images') }}/hal.png">
                                                            @else
                                                                <div class="avatar avatar-xl">
                                                                    <img alt="image" class="mr-3 rounded-circle"
                                                                        width="50"
                                                                        src="{{ asset('images') }}/{{ $villa->foto }}">
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            Rp. {{ number_format($villa->harga) }}
                                                        </td>
                                                        <td>
                                                            @if ($villa->status == 0)
                                                                <a href="{{ route('update.status.villa', [$villa->id]) }}"><button
                                                                        class="btn btn-warning"> Inactive</button></a>
                                                            @else
                                                                <a href="{{ route('update.status.villa', [$villa->id]) }}"><button
                                                                        class="btn btn-success"> Active</button></a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" type="button"
                                                                href="{{ route('villa.show', [$villa->id]) }}">Detail</a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-danger" type="button"
                                                                href="/penginapan/villa/delete/{{ $villa->id }}"
                                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>Tidak ada data villa</td>
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
                            <h5 class="modal-title" id="myModalLabel1">Tambah Villa</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form form-horizontal" action="{{ route('villa.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <?php
                                        $data = App\Models\Villa::max('kode_tempat');
                                        $huruf = 'TS';
                                        $urutan = (int) substr($data, 3, 3);
                                        $urutan++;
                                        $kode_tempat = $huruf . sprintf('%04s', $urutan);
                                        ?>
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                        <div class="col-md-4">
                                            <label>Kode</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative"><input type="text" hidden
                                                        name="kode_tempat" value="{{ $kode_tempat }}">
                                                    {{ $kode_tempat }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama Tempat*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" id="first-name-icon" value="{{ old('nama') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Deskripsi*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                                        value="{{ old('deskripsi') }}" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Lokasi*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}"
                                                        rows="2" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="https://support.google.com/maps/answer/144361?hl=id&co=GENIE.Platform%3DDesktop"
                                            target="_blank">Cara
                                            mendapatkan link maps </a>
                                        <div class="col-md-4">
                                            <label>Link Maps*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text"
                                                        class="form-control @error('maps') is-invalid @enderror"
                                                        name="maps" id="first-name-icon" value="{{ old('maps') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telp*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number"
                                                        class="form-control @error('telp') is-invalid @enderror"
                                                        name="telp" id="first-name-icon" value="{{ old('telp') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Harga*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="harga" class="form-control" type="text"
                                                        id="rupiah" placeholder="Harga" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Image*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input class="form-control @error('foto') is-invalid @enderror"
                                                        name="foto" type="file" id="foto" multiple=""
                                                        required>
                                                    @error('foto')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Kapasitas Max*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number"
                                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                                        name="kapasitas" placeholder="Kapasitas orang"
                                                        value="{{ old('kapasitas') }}" required>
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

        </div>
        <script></script>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            let table1 = document.querySelector('#event');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
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
