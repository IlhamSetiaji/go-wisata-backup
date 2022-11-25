<!DOCTYPE html>
<html lang="en">


<head>


    <title>Go-Wisata. </title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/WatuGambir.png') }}">
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

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> --}}
</head>

<header class='mb-3'>

</header>



<nav class="navbar navbar-light">
    <div class="container d-block">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-map-marker"></i>
            Go-Wisata.
        </a>
    </div>
</nav>

<div id="main-content">
    {{-- {{ dd($budgeting) }} --}}

    @if (empty($budgeting) || count($budgeting) == 0)

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">

                    <button onclick="goBack()" class=""><i class="bi bi-chevron-left"></i></button>

                </div>
            </nav>

            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">Cart</h4>
                    </div>
                    <div class="card-body">
                        <p>Tidak ada apapun dikeranjang.. mari pesan :)</p>
                    </div>
                </div>
            </div>


        </body>
    @else

        <body>
            <nav class="navbar navbar-light">
                <div class="container d-block">


                    <button onclick="goBack()"><i class="bi bi-chevron-left"></i></button>

                </div>
            </nav>

            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">Cart</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="kuliner">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">No</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Sub Total</th>
                                            {{-- <th scope="col">Catatan</th> --}}
                                            {{-- <th scope="col">Status</th> --}}
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $grandtotal = 0; ?>
                                        @foreach ($budgeting as $item)
                                        <?php
                                        $subtotal = $item['harga'] * $item['durasi'];
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    {{-- {{ dd($kuliner) }} --}}
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $item['nama_paket'] }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($item['harga']) }}
                                                </td>

                                               

                                                <td>
                                                    Rp. {{ number_format($subtotal) }}
                                                </td>
                                                <td>
                                                    {{-- <a href="{{ url('/cart/hapus/kuliner/' . $key) }}"> Batal </a> --}}
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
                                {{-- // tampilan menambah kupon --}}

                                {{-- <a href="#" class="have-code">Have a Code?</a>
                                <div class="have-code-container">
                                    <form action="{{ route('kupon.store') }}" method="POST">
                                        @csrf
                                        <input type="text">
                                        <button type="submit" class="button button-plain">Apply</button>
                                    </form>
                                </div> --}}
                                {{-- <form action="{{ url('/kupon') }}" method="POST"
                                    enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                    <div class="col-12  d-flex justify-content-end">
                                        <div class="form-group">
                                            <label for="last-name-column">Memiliki Kode Promo?</label>
                                            <input type="text" name="kode_kupon" id="kode_kupon" class="form-control">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> --}}
                                <form action="{{ url('/transaksi/tambah/kuliner') }} " method="POST"
                                    enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                    <div class="d-inline-flex p-2 bd-highlight">
                                        <div class="form-group">
                                            <th colspan="5"> <b>Catatan </b></th>
                                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" rows="1"
                                                placeholder="Tulis catatan disini jika ada.."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12  d-flex justify-content-end">
                                        <div class="form-group">
                                            <label for="last-name-column"><b>Ingin Pesan untuk Tanggal & Jam
                                                    Berapa?</b></label>
                                            <input type="datetime-local" class="form-control" id="datepicker"
                                                name="date" class="form-control @error('date') is-invalid @enderror"
                                                required>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1"> Beli</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div> --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <label class="me-1 mb-1 mr-5">Metode Pembayaran</label>
                                        <button type="submit" id="pay-button" class="btn btn-primary me-1 mb-1"
                                            name="action" value="transfer"> Bayar via transfer bank
                                        </button>

                                        <button type="submit" class="btn btn-primary me-1 mb-1" name="action"
                                            value="langsung"> Bayar ditempat
                                        </button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
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
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        function reloadpage() {
            location.reload()
        }
    </script>
    <script>
        $(function() {
            $('.datetimepicker').datetimepicker();
        });
    </script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>





</html>
