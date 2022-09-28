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
                    <h4 class="card-title"> {{ $tempat->name }} - {{ $today }} </h4>
                </div>
                <div class="card-body">
                    <div class="card-content">

                        <div class="table-responsive">
                            <table class="table table-hover" id="cart">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>A/n</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Check In</th>
                                        <th>Status</th>
                                        <th>Harga</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data2) > 0)
                                        @foreach ($data2 as $key => $data)
                                            <tr>
                                                <td>{{ $data->kode_tiket }}</td>
                                                <td>
                                                    {{ ucfirst(App\Models\User::where('id', $data->user_id)->pluck('name')->first()) }}
                                                </td>

                                                <td> {{ $data->name }}</td>
                                                <td>{{ $data->jumlah }}</td>
                                                <td>{{ $data->kedatangan }}</td>
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
                                                    Rp. {{ number_format($data->harga) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="6"> Grand Total </th>
                                            <th> Rp. {{ number_format($todayuang) }}
                                            <th> </th>
                                        </tr>
                                    @else
                                        <td>Tidak ada pesanan </td>
                                    @endif

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
