@extends('admin.layouts2.master')
@section('title', 'Today Villa')
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
    {!! Toastr::message() !!}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Pemesanan Villa: {{ $today }} </h5>
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="far fa-meh-blank"> </i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Belum Checkin</h6>

                                        <h6 class="font-extrabold mb-0">{{ count($data->where('kedatangan', 0)) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="far fa-smile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Selesai</h6>

                                        <h6 class="font-extrabold mb-0">{{ count($data->where('status', 3)) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon ">
                                            <i class="far fa-money-bill-alt"></i>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Uang Today</h6>

                                        <h6 class="font-extrabold mb-0">Rp. {{ number_format($todayuang) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>




            <div class="card-body">
                <a href="{{ route('print.today.villa', [$today]) }}" class="btn btn-light" target="_blank">
                    Print</a>
                <table class="table table-hover" id="live">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>A/n</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $key => $data)
                                <tr>
                                    <td>{{ $data->kode_tiket }}</td>
                                    <td>
                                        {{ ucfirst(App\Models\BookingVilla::where('kode_booking', $data->booking_id)->pluck('nama')->first()) }}
                                    </td>
                                    <td> {{ $data->name }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>
                                        @if ($data->status == 1)
                                            Belum Check In
                                        @elseif ($data->status == 2)
                                            Belum Check Out
                                        @elseif ($data->status == 3)
                                            Selesai
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status == 1)
                                            <a href="{{ route('update.status.cktempat', [$data->id]) }}"><button
                                                    class="btn btn-outline-primary"> Check In</button></a>
                                        @elseif ($data->status == 2)
                                            <a href="{{ route('update.status.cotempat', [$data->id]) }}"><button
                                                    class="btn btn-outline-warning"> Check Out</button></a>
                                        @elseif ($data->status == 3)
                                            <button class="btn disabled btn-primary"> Selesai</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>Tidak ada pesanan </td>
                        @endif

                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#live');
        let dataTable = new simpleDatatables.DataTable(table1);
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
