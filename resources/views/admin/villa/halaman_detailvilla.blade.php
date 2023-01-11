@extends('admin.layouts2.master')
@section('title', 'Detail Villa')



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



    {!! Toastr::message() !!}
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-md-6 col-12">
                    <img src="{{ asset('images') }}/{{ $villa->foto }}" class="card-img-top img-fluid" alt="singleminded">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Deskripsi</h4>
                            <p align="justify">{{ $villa->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Info Villa</h4>
                        </div>
                        <div class="card-content">
                            @if ($villa->status == 0)
                                <a href="{{ route('update.status.villa', [$villa->id]) }}"><button class="btn btn-danger">
                                        Inactive</button></a>
                            @else
                                <a href="{{ route('update.status.villa', [$villa->id]) }}"><button class="btn btn-warning">
                                        Active</button></a>
                            @endif
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" enctype="multipart/form-data">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Kode</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $villa->kode_tempat }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $villa->nama }}
                                                    </div>
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        Rp. {{ number_format($villa->harga) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tempat</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $villa->lokasi }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Maps</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        <a href="{{ $villa->maps }}" target="blank">Link maps</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Telp</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $villa->telp }}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Kapasitas Max</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $villa->kapasitas }} orang

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </form>
                            </div>
                            <div class="breadcrumb breadcrumb-right">
                                <a href="/penginapan/villa/rekap_penyewa/{{ $villa->id }}"> <button
                                        class="btn btn-outline-secondary me-1 mb-1">Penyewa</button></a>
                                <a href="/penginapan/villa"> <button
                                        class="btn btn-outline-secondary me-1 mb-1">Back</button></a>
                                <a data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $villa->id }}"> <button
                                        class="btn btn-outline-primary me-1 mb-1">Edit </button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Basic Modal -->
        <div class="modal fade text-left" id="ModalEdit{{ $villa->id }}" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Edit Villa</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" action="{{ route('villa.update', [$villa->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Kode</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <div class="position-relative"><input type="text" hidden
                                                    name="kode_tempat" value="{{ $villa->kode_tempat }}">
                                                {{ $villa->kode_tempat }}
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
                                                    name="nama" id="first-name-icon" value="{{ $villa->nama }}"
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
                                                    value="{{ $villa->deskripsi }}" rows="3" required>{{ $villa->deskripsi }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Lokasi*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <textarea class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ $villa->lokasi }}"
                                                    rows="2" required>{{ $villa->lokasi }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Maps*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <textarea class="form-control @error('maps') is-invalid @enderror" name="maps" value="{{ $villa->maps }}"
                                                    rows="2" required>{{ $villa->maps }}</textarea>
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
                                                    name="telp" id="first-name-icon" value="{{ $villa->telp }}"
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
                                                <input name="harga" class="form-control" type="number" id="rupiah"
                                                    placeholder="Harga" value="{{ $villa->harga }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Image*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-lefts">
                                            <div class="position-relative">
                                                <div class="form-control-icon avatar avatar.avatar-im">
                                                    <img src="{{ asset('images') }}/{{ $villa->foto }}">
                                                </div>
                                                <input class="form-control @error('foto') is-invalid @enderror"
                                                    name="foto" type="file" id="foto" multiple="">
                                                @error('foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <span class="input-group-append">
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
                                                    value="{{ $villa->kapasitas }}" required>
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
