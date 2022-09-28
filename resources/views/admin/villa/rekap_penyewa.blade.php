@extends('admin.layouts2.master')
@section('title', 'Rekap Penyewa Tempat')
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

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Rekap Data Penyewa</h3>{{ $tempat->nama }}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/penginapan/villa/rekap_penyewa/print/{{ $tempat->id }}"
                                onclick="return confirm('Mau di Print ?')">Print Rekap</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('villa.show', [$tempat->id]) }}">Back</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-lg table-hover" id="event">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode Booking</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Telp</th>
                                            <th scope="col">Check In</th>
                                            <th scope="col">Check Out</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach (App\Models\BookingVilla::where('villa_id', $tempat->id)->orderby('checkin', 'desc')->get() as $booking)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $booking->kode_booking }}</td>
                                                <td>{{ $booking->nama }}</td>
                                                <td>{{ $booking->telp }}</td>
                                                <td>{{ $booking->checkin }}</td>
                                                <td>{{ $booking->checkout }}</td>
                                                <td>
                                                    @php
                                                        $pay = App\Models\Pay::where('kodeku', $booking->kode_tiket)->first();
                                                    @endphp
                                                    @if (!$pay == null)
                                                        @if ($pay->status_message == 'settlement')
                                                            <button class="btn disabled btn-primary"> Sudah Dibayar</button>
                                                        @elseif ($pay->status_message == 'pending')
                                                            <button class="btn disabled btn-warning"> Menunggu
                                                                Dibayar</button>
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
                </div>
            </div>
        </section>
    </div>
    <!-- DataTables -->
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        let table1 = document.querySelector('#event');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endsection
