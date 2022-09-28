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
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>




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
    {!! Toastr::message() !!}
    @if (empty($cartc) || count($cartc) == 0)

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">

                    <button class="btn btn-secondary rounded-pill" onclick="goBack()" class=""><i
                            class="bi bi-chevron-left"></i> Kembali</button>


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

                                    @foreach ($camping as $key => $camping)
                                        @if ($camping['makan'] == 'include')
                                            <div class="row">
                                                {{-- <br> --}}
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
                                                    <label>Camping</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            {{ $camping['date'] }} sampai {{ $camping['date2'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Jumlah Orang</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            {{ $camping['jumlah_orang'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tenda</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            Tidak menyewa
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($i == 1)
                                                    <div class="col-md-4">
                                                        <label>Makan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                @if ($camping['makan'] == 'include')
                                                                    {{ $camping['makan'] }} x
                                                                    {{ $camping['makan_durasi'] }} hari
                                                                    <?php
                                                                    $hargamakan = App\Models\Camp::where('tempat_id', $camping['tempat_id'])
                                                                        ->where('kategori', 'makan')
                                                                        ->pluck('harga')
                                                                        ->first();
                                                                    $totalmakan = (int) $hargamakan * $camping['makan_durasi'] * $camping['jumlah_orang'];
                                                                    ?>

                                                                    {{-- {{ App\Models\Camp::where('tempat_id',$camping["tempat_id"] )->where('kategori','makan')->pluck('harga')->first() }} --}}
                                                                @else
                                                                    {{ $camping['makan'] }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($camping['makan'] == 'include')
                                                    <div class="col-md-4">
                                                        <label>Total</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">

                                                                @if ($i == 1)
                                                                    Rp {{ number_format($totalmakan) }}
                                                                @else
                                                                    Free
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-4">
                                                        <label>Total</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                Free
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-mb-4">
                                                    <br>
                                                </div>

                                            </div>
                                        @else
                                            <h1>Langsung Datang Saja, Tempatnya Gratis!!!</h1>
                                        @endif
                                    @endforeach
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


                    <button class="btn btn-secondary rounded-pill" onclick="goBack()" class=""><i
                            class="bi bi-chevron-left"></i> Kembali</button>


                </div>
            </nav>

            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title breadcrumb breadcrumb-center">CheckOut </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            @foreach ($camping as $key => $camping)
                                <?php
                                // var_dump($camping);
                                $durasii = $camping['makan_durasi'];
                                $tempat_name = $camping['tempat_name'];
                                $jumlah_orang = $camping['jumlah_orang'];
                                $makan = $camping['makan'];
                                ?>
                                <div class="row">
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
                                        <label>Camping</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                {{ $camping['date'] }} sampai {{ $camping['date2'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jumlah Orang</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                {{ $camping['jumlah_orang'] }} Guest
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                            <label>Makan</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    @if ($camping['makan'] == 'include')
                                    {{ $camping["makan"]}} x {{ $camping["makan_durasi"] }} hari =
                            <?php
                            $hargamakan = App\Models\Camp::where('tempat_id', $camping['tempat_id'])
                                ->where('kategori', 'makan')
                                ->pluck('harga')
                                ->first();
                            $totalmakan = (int) $hargamakan * $camping['makan_durasi'] * $camping['jumlah_orang'];
                            $makan = 1;
                            ?>
                            Rp. {{ number_format($totalmakan) }}




                            @else
                            <?php
                            $makan = 0;
                            ?>
                            {{ $camping["makan"]}}
                            @endif
                        </div>
                    </div>
                </div> --}}
                                    <div class="col-md-4">
                                        <label>Sewa Tenda </label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-mb-4">
                                        <br>
                                    </div>

                                </div>
                            @endforeach
                        </div>




                        <div class="card-content">

                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="cart">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Durasi</th>

                                            <th scope="col">Sub Total</th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $grandtotal = 0; ?>
                                        @foreach ($cartc as $key => $cart)
                                            <?php
                                            $subtotal = $cart['harga_produk'] * $cart['jumlah'] * $cart['durasi'];
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $cart['nama_produk'] }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($cart['harga_produk']) }}
                                                </td>

                                                <td>
                                                    x {{ $cart['jumlah'] }}
                                                </td>
                                                <td>
                                                    {{ $cart['durasi'] }} Hari
                                                </td>

                                                {{-- <td>
                                        {{ $cart["tanggal_a"]}} - {{ $cart["tanggal_b"]}}
                            </td> --}}


                                                <td>
                                                    Rp. {{ number_format($subtotal) }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('/cart/hapus/camping/' . $key) }}"> Batal </a>
                                                </td>


                                            </tr>
                                            <?php $grandtotal += $subtotal;
                                            ?>
                                        @endforeach
                                        <tr>
                                            <th colspan="6"> Grand Total </th>
                                            {{-- @if ($makan == 1)
                                    <?php $total = $grandtotal + $totalmakan; ?>
                                    <th> Rp. {{ number_format($total) }}
                            <th> </th>
                            @else --}}
                                            <?php $total = $grandtotal; ?>
                                            <th> Rp. {{ number_format($total) }}
                                            <th> </th>
                                            {{-- @endif --}}
                                        </tr>


                                    </tbody>
                                </table>
                                <form action="{{ url('/transaksi/tambah/camping') }} " method="POST"
                                    enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                    <div class="col-12  d-flex justify-content-end">
                                        <div class="form-group">

                                            <input type="hidden" id="first-name-column" class="form-control"
                                                name="total" value="{{ $total }}">
                                            <input type="hidden" id="first-name-column" class="form-control"
                                                name="durasii" value="{{ $durasii }}">
                                            <input type="hidden" id="first-name-column" class="form-control"
                                                name="tempat_name" value="{{ $tempat_name }}">
                                            <input type="hidden" id="first-name-column" class="form-control"
                                                name="jumlah_orang" value="{{ $jumlah_orang }}">
                                            <input type="hidden" id="first-name-column" class="form-control"
                                                name="makan" value="{{ $makan }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        {{-- <button type="submit" class="btn btn-primary me-1 mb-1"> Pesan</button> --}}
                                        <button type="submit" class="btn btn-primary me-1 mb-1" name="action"
                                            value="epay"> Bayar via
                                            E-pay
                                        </button>
                                        <button type="submit" id="pay-button" class="btn btn-primary me-1 mb-1"
                                            name="action" value="transfer"> Bayar via transfer bank
                                        </button>

                                        <button type="submit" class="btn btn-primary me-1 mb-1" name="action"
                                            value="langsung"> Bayar
                                            ditempat
                                        </button>
                                    </div>

                                    {{-- <li class="breadcrumb breadcrumb-right">    <a href="{{ url('/transaksi/tambah') }}" class="btn
                    btn-outline-primary ">Beli </a></li> --}}
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
