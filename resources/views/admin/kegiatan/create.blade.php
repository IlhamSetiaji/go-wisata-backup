@extends('admin.layouts2.master')
@section('title', 'Tambah Kegiatan')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    {!! Toastr::message() !!}
    @foreach ($errors->all() as $error)
        {!! Toastr::error($error, 'Error', ['options']) !!}
    @endforeach
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Kegiatan</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data kegiatan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Kegiatan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form action="{{ route('kegiatan.store') }} " method="POST" enctype="multipart/form-data"
                                    class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <label>Kode Kegiatan</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                                        placeholder="Name" id="first-name-icon" value="{{ old('name') }}" required> --}}
                                                        {{ $kode_kegiatan }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tempat</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        <input type="text" hidden name="tempat_id"
                                                            value="{{ $tempat->id }}">
                                                        <input type="text" hidden name="user_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <input type="text" hidden name="kode_kegiatan"
                                                            value="{{ $kode_kegiatan }}">
                                                        {{ $tempat->name }}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" placeholder="Nama kegiatan" id="first-name-icon"
                                                            value="{{ old('name') }}" required>

                                                        <div class="form-control-icon">
                                                            {{-- <i class="fas fa-child"></i> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Deskripsi</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                                            value="{{ old('deskripsi') }}" rows="3"
                                                            required></textarea>
                                                        <div class="form-control-icon">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input name="harga" class="form-control" type="number" id="rupiah"
                                                            placeholder="Harga">
                                                        <div class="form-control-icon">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <label>Image</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input class="form-control @error('image') is-invalid @enderror"
                                                            name="image" type="file" id="image" multiple="">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person-square"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tanggal</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" id="daterange"
                                                            name="daterange" />
                                                        <div class="form-control-icon">
                                                            {{-- <i class="bi bi-person-square"></i> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <label>Mulai</label>
                                            </div>

                                            <div class="col-md-6 ">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="time" id="jb" name="jambuka"
                                                            class="form-control @error('jambuka') is-invalid @enderror"
                                                            value="{{ old('jambuka') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Selesai</label>
                                            </div>

                                            <div class="col-md-6 ">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="time" id="jt" name="jamtutup"
                                                            class="form-control @error('jamtutup') is-invalid @enderror"
                                                            value="{{ old('jamtutup') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                            <label>Selesai</label>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="time" name="jamtutup" class="form-control" value="{{ old('jamtutup') }}">

                                                </div>
                                            </div>
                                        </div> --}}
                                            <div class="col-md-4">
                                                <label>Kapasitas</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="number"
                                                            class="form-control @error('kapasitas') is-invalid @enderror"
                                                            name="kapasitas" placeholder="Kapasitas"
                                                            value="{{ old('kapasitas') }}">
                                                        <div class="form-control-icon">
                                                            {{-- <i class="bi bi-phone"></i> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control"  name="alamat"
                                                    rows="3" required></textarea>
                                                    <div class="form-control-icon">
                                                    <i class="far fa-map"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div> --}}
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- Hoverable rows end -->
    <a class=" nav-link" href="{{ route('kegiatan.index') }}"> <span>List Kegiatan</span></a>

    </div>
    <!-- list group button & badge ends -->
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
