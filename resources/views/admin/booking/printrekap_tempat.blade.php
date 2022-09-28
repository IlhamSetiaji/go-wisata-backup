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

<header class='mb-3'>

</header>
<nav class="navbar navbar-light">
    <div class="container d-block">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-map-marker"></i>
            GoWisata.
        </a>
    </div>
</nav>

<div id="main-content">

    <body>

        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title"> Rekap Data {{ $tempat->name }}</h4> {{ $tgl_a }} sampai
                    {{ $tgl_b }} <br>
                    Total Pesanan : {{ $count }} <br> Total Dana : Rp. {{ number_format($total) }}
                </div>
                <div class="card-body">
                    <div class="card-content">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="rekaps">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Status</th>
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
                                                        Berhasil Dibayar
                                                    @elseif ($pay->status_message == 'pending')
                                                        Menunggu Dibayar
                                                    @elseif ($pay->status_message == 'expire')
                                                        Expire
                                                    @elseif ($pay->status_message == 'cancel')
                                                        Dibatalkan
                                                    @endif
                                                @else
                                                    Belum Membayar
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
