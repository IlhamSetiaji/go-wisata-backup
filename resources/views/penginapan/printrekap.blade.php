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

        {{-- startDate', 'endDate', 'data', 'count', 'default', 'total' --}}
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title"> Rekap Data {{ $tempat->name }}</h4> {{ $tgl_a }} sampai
                    {{ $tgl_b }} <br>
                    Total Pesanan : {{ $count }} <br> Total Dana : Rp. {{ number_format($total) }}
                </div>
                <div class="card-body">
                    <div class="card-content">

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="rekaps">
                                <thead>
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Checkin </th>
                                        <th scope="col">Kamar</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>
                                                {{ App\Models\User::where('id', $data->user_id)->pluck('name')->first() }}
                                                {{-- {{ $data->user_id }} --}}
                                            </td>
                                            <?php
                                            $value = App\Models\Detail_booking::where('kode_tiket', $data->kode_tiket)->first();
                                            $db2 = App\Models\EventBooking::where('kode_tiket', $data->kode_tiket)
                                                ->where('title', 'Booked')
                                                ->get();
                                            ?>
                                            <td>
                                                {{ $value->jumlah_orang }} Orang
                                            </td>
                                            <td>

                                                {{ $value->checkin }} Sampai {{ $value->checkout }}


                                            </td>
                                            <td>
                                                {{ $data->id_produk }}
                                            </td>



                                            <td>
                                                Rp. {{ number_format($data->harga) }}
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
