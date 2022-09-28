@extends('admin.layouts2.master')
@section('title', 'Detail Event')



@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
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



    {!! Toastr::message() !!}
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-md-6 col-12">
                    <img src="{{ asset('images') }}/{{ $event->foto }}" class="card-img-top img-fluid" alt="singleminded">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Deskripsi</h4>
                            <p align="justify">{{ $event->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Info Event</h4>
                        </div>
                        <div class="card-content">
                            @if ($event->status == 0)
                                <a href="{{ route('update.status.event', [$event->id]) }}"><button class="btn btn-danger">
                                        Inactive</button></a>
                            @else
                                <a href="{{ route('update.status.event', [$event->id]) }}"><button class="btn btn-warning">
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
                                                        {{ $event->kode_event }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Kategori Event</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $event->kategorievent->nama_kategori }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $event->nama }}
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
                                                        Rp. {{ number_format($event->harga) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tanggal </label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        <?php
                                                        $tgl_a = date('d F Y', strtotime($event->tgl_buka));
                                                        $tgl_b = date('d F Y', strtotime($event->tgl_tutup));
                                                        ?>
                                                        {{ $tgl_a }} - {{ $tgl_b }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Waktu</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $event->waktu_mulai }} - {{ $event->waktu_selesai }} WIB

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tempat</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $event->lokasi }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Video</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        <a href="{{ $event->link_video }}" target="blank">Link video</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tersedia</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        @if ($event->kapasitas_akhir >= $event->kapasitas_awal)
                                                            Full
                                                        @else
                                                            <?php
                                                            $sisa = (int) $event->kapasitas_awal - (int) $event->kapasitas_akhir;
                                                            ?>
                                                            Ya,
                                                            {{ $event->kapasitas_akhir }}/{{ $event->kapasitas_awal }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </form>
                            </div>
                            <div class="breadcrumb breadcrumb-right">
                                <a href="/adminevent"> <button class="btn btn-outline-secondary me-1 mb-1">Back</button></a>
                                {{-- <a data-bs-toggle="modal" data-bs-target="#peserta{{ $event->id }}"> <button
                                        class="btn btn-outline-secondary me-1 mb-1">Peserta</button></a> --}}
                                <a href="/adminevent/rekap_pesertaevent/{{ $event->id }}"> <button
                                        class="btn btn-outline-secondary me-1 mb-1">Peserta</button></a>
                                <a data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $event->id }}"> <button
                                        class="btn btn-outline-primary me-1 mb-1">Edit </button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Basic Modal -->
        <div class="modal fade text-left" id="ModalEdit{{ $event->id }}" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Edit Event</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" action="/event/{{ $event->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Kode</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <div class="position-relative"><input type="text" hidden name="kode_event"
                                                    value="{{ $event->kode_event }}">
                                                {{ $event->kode_event }}
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
                                                <?php
                                                foreach ($kategorievent as $ke) {
                                                    echo "<option value='$ke->id'";
                                                    echo $event['kategorievent_id'] == $ke->id ? 'selected' : '';
                                                    echo ">$ke->nama_kategori</option>";
                                                }
                                                ?>
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
                                                    name="nama" id="first-name-icon" value="{{ $event->nama }}"
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
                                                    value="{{ $event->deskripsi }}" rows="3" required>{{ $event->deskripsi }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Lokasi *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <textarea class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ $event->lokasi }}"
                                                    rows="2" required>{{ $event->lokasi }}</textarea>
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
                                                    value="{{ $event->waktu_mulai }}" required>

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
                                                    value="{{ $event->waktu_selesai }}" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tanggal Buka *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input required type="date" class="form-control" id="daterange"
                                                    name="tgl_buka" value="{{ $event->tgl_buka }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tanggal Selesai *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input required type="date" class="form-control" id="daterange"
                                                    name="tgl_tutup" value="{{ $event->tgl_tutup }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Harga *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input required name="harga" class="form-control" type="text"
                                                    id="rupiah" placeholder="Harga" value="{{ $event->harga }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Image *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-lefts">
                                            <div class="position-relative">
                                                <div class="form-control-icon avatar avatar.avatar-im">
                                                    <img src="{{ asset('images') }}/{{ $event->foto }}">
                                                </div>
                                                <input type="file"
                                                    class="form-control file-upload-info @error('foto') is-invalid @enderror"
                                                    placeholder="Upload Image" name="foto">
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
                                        <label>Link video</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control @error('link_video') is-invalid @enderror"
                                                    name="link_video" placeholder="Link video youtube jika ada"
                                                    value="{{ $event->link_video }}">
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
                                                    value="{{ $event->kapasitas_awal }}" required>
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
        <!--Basic Modal -->
        <div class="modal fade text-left" id="peserta{{ $event->id }}" tabindex="-1"
            aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Peserta Event</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" action="/event/{{ $event->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                @php
                                    $kegi = App\Models\BookingEvent::where('event_id', $event->id)->get();
                                    $i = 1;
                                @endphp
                                <div class="row">
                                    @foreach ($kegi as $p)
                                        @php
                                            $peserta = App\Models\PesertaEvent::where('kode_booking', $p->kode_booking)->get();
                                        @endphp
                                        @foreach ($peserta as $pe)
                                            <div class="col-md-8">
                                                {{ $i++ }} . {{ $pe->nama_peserta }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                    </div>
                    <div class=" modal-footer">
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
