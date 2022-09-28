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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <body>
        <div class="container">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <form action="/explore-tempatsewa/search/{{ $tempatsewa->id }}" method="get"
                            enctype="multipart/form-data"> @csrf
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Checkin - Checkout</label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <div class="input-group">
                                                            {{-- <input type="text" class="form-control"
                                                                placeholder="Check In" disabled> --}}
                                                            <input type="date" name="checkin" id="datefield"
                                                                class="form-control checkin-date @error('checkin') is-invalid @enderror"
                                                                required>
                                                            <input type="time" name="time_checkin"
                                                                class="form-control checkin-date" step="1800" required>
                                                            {{-- <input type="text" class="form-control"
                                                                placeholder="Check Out" disabled> --}}
                                                            <input type="date" name="checkout" id="datefield2"
                                                                class="form-control checkout-date @error('checkout') is-invalid @enderror"
                                                                required>
                                                            <input type="time" name="time_checkout" step="1800"
                                                                class="form-control checkin-date" required>
                                                            <button class="btn btn-primary" type="submit">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @isset($data_ruang)
                            @if (!count($data_ruang) > 0)
                                <p>Tidak ada ruangan di tempat ini, silahkan mencari tempat lain :) </p>
                            @else
                                @foreach ($data_ruang as $dr)
                                    <div class="col-12 col-xl-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <h5 align="center">{{ $dr->nama }}</h5>
                                                                <img src="{{ asset('images') }}/{{ $dr->foto }}"
                                                                    style="width:260px;height:215px;">
                                                                <input type="name" class="form-control" name="name"
                                                                    value="Rp. {{ number_format($dr->harga) }} / jam" readonly>
                                                                <input type="name" class="form-control" name="name"
                                                                    value="Kapasitas = {{ $dr->kapasitas }} orang" readonly>
                                                                @isset($checkin)
                                                                    @isset($checkout)
                                                                        <a type="button" class="btn btn-primary"
                                                                            href="/formpesan/tempatsewa/{{ $checkin }}/{{ $checkout }}/{{ $dr->id }}">Pesan</a>
                                                                    @endisset
                                                                @endisset
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endisset
                        @isset($ruang)
                            @if (!count($ruang) > 0)
                                <p>Tidak ada ruangan di tempat ini, silahkan mencari tempat lain :) </p>
                            @else
                                @foreach ($ruang as $r)
                                    <div class="col-12 col-xl-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <h5 align="center">{{ $r->nama }}</h5>
                                                                <img src="{{ asset('images') }}/{{ $r->foto }}"
                                                                    style="width:260px;height:215px;">
                                                                <p align="justify">{{ $r->deskripsi }}</p>
                                                                <input type="name" class="form-control" name="name"
                                                                    value="Rp. {{ number_format($r->harga) }} / jam" disabled>
                                                                </br>
                                                                <input type="name" class="form-control" name="name"
                                                                    value="Kapasitas = {{ $r->kapasitas }} orang" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pesanan</h4>
                        </div>
                        <div class="card-content pb-4">
                            <div class="recent-message d-flex px-4 py-3">
                                <p>Tempat : {{ $tempatsewa->nama }}</br>
                                    Telp : {{ $tempatsewa->telp }} </br>
                                    Lokasi : {{ $tempatsewa->lokasi }} </br>
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
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

        });
    </script>
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("min", today);
        document.getElementById("datefield2").setAttribute("min", today);
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
