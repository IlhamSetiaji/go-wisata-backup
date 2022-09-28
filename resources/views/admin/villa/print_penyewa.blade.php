<!DOCTYPE html>
<html lang="en">

<head>
    <title>GoWisata. </title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/GoWisata.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-map-marker"></i>
                GoWisata.
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title"> Rekap Data Penyewa
            </div>
            <div class="card-body">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="rekaps">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Booking</th>
                                    <th>Nama </th>
                                    <th>Telp </th>
                                    <th>Check In </th>
                                    <th>Check Out </th>
                                    <th>Status</th>
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
</body>
<script>
    window.print();
</script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


</html>
