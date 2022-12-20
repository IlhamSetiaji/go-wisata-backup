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





<nav class="navbar navbar-light">
    <div class="container d-block">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-map-marker"></i>
            GoWisata.
        </a>
    </div>
</nav>

<div id="main-content">

    @if (empty($penginapan2) || count($penginapan2) == 0)

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">

                    <button onclick="goBack()" class=""><i class="bi bi-chevron-left"></i>Kembali</button>

                </div>
            </nav>

            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title breadcrumb breadcrumb-center">CheckOut </h4>
                    </div>
                    <div class="row">
                        <div class="card mt-5 col-md-4">
                        </div>
                        <div class="card mt-5 col-md-6">
                            <div class="card-body">
                                <div class="form-body">
                                    <p>Tidak ada apapun dikeranjang.. mari pesan :)</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5 col-md-2">
                        </div>
                    </div>
                </div>
            </div>


        </body>
    @else

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">


                    <button onclick="goBack()"><i class="bi bi-chevron-left"></i> Kembali</button>

                </div>
            </nav>

            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title breadcrumb breadcrumb-center">CheckOut </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                {{-- <br> --}}
                                @foreach ($penginapan2 as $key => $penginapan)
                                    {{-- {{ dd($penginapan) }} --}}
                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            A/n {{ Auth::user()->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Tempat</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <?php
                                            $tempat = App\Models\Tempat::where('id', $penginapan['tempat_id'])->first();
                                            ?>
                                            {{ $tempat->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Pemesanan</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            {{ $penginapan['checkin'] }} sampai {{ $penginapan['checkout'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Jumlah Orang</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            {{ $penginapan['jumlah_orang'] }} Guest
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label>Durasi Pemesanan</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            {{ $penginapan['durasi'] }} Hari
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            @endforeach




                            <div class="card-content">

                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="penginapan">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Harga</th>


                                                <th scope="col">Sub Total</th>
                                                <th scope="col"></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            $grandtotal = 0; ?>
                                            @foreach ($penginapan2 as $key => $penginapan)
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        {{-- {{ dd($penginapan) }} --}}
                                                        {{ $no++ }}
                                                    </td>
                                                    <td>
                                                        {{-- {{  $penginapan["kode_kamar"] }} --}}
                                                        <?php
                                                        $kamar = App\Models\Kamar::where('kode_kamar', $penginapan['kode_kamar'])->first();
                                                        ?>
                                                        {{-- {{ dd($kamar) }} --}}
                                                        {{ $kamar->name }}
                                                    </td>
                                                    <td>
                                                        {{-- Rp. {{ $penginapan["harga_produk"]}} --}}
                                                        Rp. {{ number_format($kamar->harga) }}
                                                    </td>


                                                    <td>
                                                        <?php
                                                        $subtotal = $penginapan['durasi'] * $kamar->harga;
                                                        ?>
                                                        Rp. {{ number_format($subtotal) }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/cart/hapus/penginapan/' . $key) }}"> Batal
                                                        </a>
                                                    </td>


                                                </tr>
                                                <?php $grandtotal += $subtotal; ?>
                                            @endforeach
                                            <tr>
                                                <th colspan="4"> Grand Total </th>
                                                <th> Rp. {{ number_format($grandtotal) }}
                                                <th> </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <form action="{{ url('/transaksi/tambah/booking') }} " method="POST"
                                        enctype="multipart/form-data" class="form form-horizontal">
                                        @csrf
                                        <div class="col-12  d-flex justify-content-end">
                                            <div class="form-group">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                    name="total" value="{{ $grandtotal }}">
                                                @foreach ($penginapan2 as $key => $penginapan)
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                name="durasi" value="{{ $penginapan['durasi'] }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                name="tempat_id" value="{{ $penginapan['tempat_id'] }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                name="jumlah_orang" value="{{ $penginapan['jumlah_orang'] }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                name="checkin" value="{{ $penginapan['checkin'] }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                name="checkout" value="{{ $penginapan['checkout'] }}">
                                                @endforeach
                                                <input type="text" id="first-name-column" class="form-control"
                                                    name="nik" required placeholder="masukan nomor NIK">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1"> Pesan</button>

                                        </div>

                                        {{-- <li class="breadcrumb breadcrumb-right">    <a href="{{ url('/transaksi/tambah') }}" class="btn btn-outline-primary ">Beli </a></li> --}}
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </body>



    @endif



    </body>

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
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        function reloadpage() {
            location.reload()
        }
    </script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('assets/js/main.js') }}"></script>


</html>
