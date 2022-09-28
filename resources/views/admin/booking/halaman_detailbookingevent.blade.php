@extends('admin.layouts2.master')
@section('title', 'Detail Booking Event')

@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
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
                    <img src="{{ asset('images') }}/{{ $bookingevent->event->foto }}" class="card-img-top img-fluid"
                        alt="singleminded">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Pesanan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        @php
                                            $peserta = App\Models\PesertaEvent::where('kode_booking', $bookingevent->kode_booking)->get();
                                            $i = 1;
                                        @endphp
                                        @foreach ($peserta as $p)
                                            <div class="col-md-4">
                                                <label>Peserta {{ $i++ }}:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $p->nama_peserta }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Pesanan</h4>
                        </div>
                        <div class="card-content">
                            @php
                                $pay = App\Models\Pay::where('id', $bookingevent->kode_tiket)->first();
                            @endphp
                            @if (!$pay == null)
                                @if ($pay->status_message == 'settlement')
                                    <button class="btn disabled btn-primary"> Berhasil Dibayar</button>
                                @elseif ($pay->status_message == 'pending')
                                    <button class="btn disabled btn-warning"> Menunggu Dibayar</button>
                                @elseif ($pay->status_message == 'expire')
                                    <button class="btn disabled btn-danger"> Expire</button>
                                @elseif ($pay->status_message == 'cancel')
                                    <button class="btn disabled btn-danger"> Dibatalkan</button>
                                @endif
                            @else
                                <button class="btn disabled btn-primary"> Belum Membayar</button>
                            @endif
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" enctype="multipart/form-data">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Kode Booking</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->kode_booking }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->nama }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email User</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah orang</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->jml_orang }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Biaya</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        Rp. {{ number_format($bookingevent->biaya) }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tgl daftar</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->created_at }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama Event</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->event->nama }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Lokasi</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->event->lokasi }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tgl Event</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->event->tgl_buka }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Waktu</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group ">
                                                    <div class="position-relative">
                                                        {{ $bookingevent->event->waktu_mulai }}-{{ $bookingevent->event->waktu_selesai }}
                                                        WIB
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                    </div>

                                </form>
                            </div>
                            <div class="breadcrumb breadcrumb-right">
                                <a href="/bookingevent"> <button
                                        class="btn btn-outline-secondary me-1 mb-1">Back</button></a>
                                {{-- <a data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $bookingevent->id }}"> <button
                                        class="btn btn-outline-primary me-1 mb-1">Edit </button></a> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Basic Modal -->
        <div class="modal fade text-left" id="ModalEdit{{ $bookingevent->id }}" tabindex="-1"
            aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Edit Pesanan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal"
                            action="{{ route('bookingevent.update', [$bookingevent->id]) }}" method="POST"
                            enctype="multipart/form-data">
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
                                                    name="kode_booking" value="{{ $bookingevent->kode_booking }}">
                                                {{ $bookingevent->kode_booking }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Event</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <select name="event_id" class="selectpicker form-select" required
                                                aria-label=".form-select-sm example" data-live-search="true">
                                                <?php
                                                foreach ($event as $e) {
                                                    echo "<option value='$e->id'";
                                                    echo $bookingevent['event_id'] == $e->id ? 'selected' : '';
                                                    echo ">$e->nama</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Nama </label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    name="nama" id="first-name-icon"
                                                    value="{{ $bookingevent->nama }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Alamat</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    name="alamat" id="first-name-icon"
                                                    value="{{ $bookingevent->alamat }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Telepon</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <input type="number" class="form-control @error('telp') is-invalid @enderror"
                                                name="telp" id="first-name-icon" value="{{ $bookingevent->telp }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jumlah orang</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <input type="number"
                                                class="form-control @error('jml_orang') is-invalid @enderror"
                                                name="jml_orang" id="first-name-icon"
                                                value="{{ $bookingevent->jml_orang }}" required>
                                        </div>
                                        <div class="position-relative">
                                            <input type="hidden" name="user_id" class="form-control"
                                                value="{{ auth()->user()->id }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary me-1 mb-1">Edit</button>
                                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
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
