@extends('admin.layouts2.master')
@section('title', 'Rekap Data')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
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
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Rekap Data Pemesanan</h3>
                    <p class="text-subtitle text-muted">Halaman untuk merekap data pesanan</p>
                    <form action="/rekapdata_ep" method="post">
                        @csrf
                        <div class="form-group">
                            <h6>Range Waktu Rekap</h6>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <select class="form-select" name="kategori">
                                    <option value="events">Event</option>
                                    <option value="tempat sewa">Tempat Sewa</option>
                                </select>
                                <input type="text" class="form-control" id="daterange" name="daterange" />
                                <button class="btn btn-primary" type="submit" name="submit" value="table">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @isset($data)
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h6> Data Rekap </h6>{{ $tgl_a }} Sampai {{ $tgl_b }} ({{ $count }} Pesanan )
                    <br>
                    Total Dana Rp. {{ number_format($total) }}
                    <br>
                    <br>
                    @if ($d->kategori == 'events')
                        <a href="/rekapdata_ep/print/{{ $default }}/events" onclick="return confirm('Mau di Print ?')"><i
                                class="fas fa-print" style="font-size: 30px;" target="blank"></i></span>
                        @elseif ($d->kategori == 'tempat sewa')
                            <a href="/rekapdata_ep/print/{{ $default }}/tempatsewa"
                                onclick="return confirm('Mau di Print ?')"><i class="fas fa-print" style="font-size: 30px;"
                                    target="blank"></i></span>
                            </a>
                    @endif

                    &nbsp; &nbsp;
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered" id="rekaps">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>User</th>
                                <th>Nama</th>
                                <th>Guest</th>
                                <th>Biaya</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data as $data)
                                <tr>
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <td>
                                        {{ $data->booking_id }}
                                    </td>
                                    <td>
                                        {{ App\Models\User::where('id', $data->user_id)->pluck('name')->first() }}
                                    </td>
                                    <td>
                                        {{ $data->name }}
                                    </td>
                                    <td>
                                        {{ $data->jumlah }}
                                    </td>
                                    <td>
                                        Rp. {{ number_format($data->harga) }}
                                    </td>
                                    <td>
                                        @php
                                            $pay = App\Models\Pay::where('kodeku', $data->kode_tiket)->first();
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
                                            <button class="btn disabled btn-warning"> Belum Membayar</button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endisset


    <!-- DataTables -->
    <script src="{{ url('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ url('vendor/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#rekaps').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: false,
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'colvis',
                        postfixButtons: ['colvisRestore']
                    },
                    {
                        extend: 'copy',

                        text: '<i class="far fa-copy"></i> Copy'
                    },
                    {
                        extend: 'excel',

                        text: '<i class="far fa-file-excel"></i> Excel',
                        title: 'Rekap Excel'
                    },
                    {
                        extend: 'pdf',

                        text: '<i class="far fa-file-pdf"></i> Pdf',
                        title: 'Rekap PDF'
                    },
                    {
                        extend: 'csv',

                        text: '<i class="fas fa-file-csv"></i> CSV',
                        title: 'Rekap CSV'
                    },
                    {
                        extend: 'print',

                        text: '<i class="fas fa-print"></i> Print'
                    }
                ]


            });

        });
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
@endsection
