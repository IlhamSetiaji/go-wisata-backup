@extends('admin.layouts2.master')
@section('title', 'Daftar Event')



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

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Event</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data event </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Event</a></li>
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
                                                    class="btn btn-outline-primary me-1 mb-1">Tambah Event</button></a>
                                            <a href="/adminevent/calender"> <button
                                                    class="btn btn-outline-primary me-1 mb-1">Calender</button></a>
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
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Available</th>
                                                <th scope="col" colspan="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($event) > 0)
                                                @foreach ($event as $key => $event)
                                                    <tr>
                                                        <td>
                                                            {{ $key + 1 }}
                                                        </td>
                                                        <td>
                                                            {{ $event->nama }}
                                                        </td>
                                                        <td>
                                                            @if ($event->foto == null)
                                                                <img alt="image" class="mr-3 rounded-circle"
                                                                    width="50" src="{{ asset('images') }}/hal.png">
                                                            @else
                                                                <div class="avatar avatar-xl">
                                                                    <img alt="image" class="mr-3 rounded-circle"
                                                                        width="50"
                                                                        src="{{ asset('images') }}/{{ $event->foto }}">
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $tgl_a = date('d F Y', strtotime($event->tgl_buka));
                                                            $tgl_b = date('d F Y', strtotime($event->tgl_tutup));
                                                            ?>
                                                            {{ $tgl_a }} - {{ $tgl_b }}
                                                        </td>
                                                        <td>
                                                            @if ($event->status == 0)
                                                                <a href="{{ route('update.status.event', [$event->id]) }}"><button
                                                                        class="btn btn-warning"> Inactive</button></a>
                                                            @else
                                                                <a href="{{ route('update.status.event', [$event->id]) }}"><button
                                                                        class="btn btn-success"> Active</button></a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($event->kapasitas_akhir >= $event->kapasitas_awal)
                                                                <button class="btn btn-primary"> Full</button>
                                                            @else
                                                                <?php
                                                                $sisa = (int) $event->kapasitas_awal - (int) $event->kapasitas_akhir;
                                                                ?>
                                                                Ya,
                                                                {{ $event->kapasitas_akhir }}/{{ $event->kapasitas_awal }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" type="button"
                                                                href="/adminevent/detail/{{ $event->id }}">Detail</a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-danger" type="button"
                                                                href="/event/{{ $event->id }}/delete"
                                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>Tidak ada data event</td>
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
                            <h5 class="modal-title" id="myModalLabel1">Tambah Event</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form form-horizontal" action="/event/create" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <?php
                                        $data = App\Models\Event::max('kode_event');
                                        $huruf = 'EK';
                                        $urutan = (int) substr($data, 3, 3);
                                        $urutan++;
                                        $kode_event = $huruf . sprintf('%04s', $urutan);
                                        ?>
                                        <div class="col-md-4">
                                            <label>Kode</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative"><input type="text" hidden
                                                        name="kode_event" value="{{ $kode_event }}">
                                                    {{ $kode_event }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Kategori *</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <select name="kategorievent_id" class="selectpicker form-select" required
                                                    aria-label=".form-select-sm example" data-live-search="true">
                                                    @foreach ($kategorievent as $ke)
                                                        <option value="{{ $ke->id }}">
                                                            {{ $ke->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama Event *</label>
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
                                            <label>Deskripsi *</label>
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
                                            <label>Lokasi *</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}"
                                                        rows="2" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mulai *</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="time" id="jb" name="waktu_mulai"
                                                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                                                        value="{{ old('waktu_mulai') }}" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Selesai *</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="time" id="jt" name="waktu_selesai"
                                                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                                                        value="{{ old('waktu_selesai') }}" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal *</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="daterange"
                                                        name="daterange" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Harga *</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="harga" class="form-control" 
                                                        id="rupiah" placeholder="Harga" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Image *</label>
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
                                            <label>Link video</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text"
                                                        class="form-control @error('link_video') is-invalid @enderror"
                                                        name="link_video" placeholder="Link video youtube jika ada"
                                                        value="{{ old('link_video') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Kapasitas *</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number"
                                                        class="form-control @error('kapasitas_awal') is-invalid @enderror"
                                                        name="kapasitas_awal" placeholder="Kapasitas orang"
                                                        value="{{ old('kapasitas_awal') }}" required>
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
