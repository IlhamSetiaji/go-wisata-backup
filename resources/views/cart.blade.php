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
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-hH-4E7hWQH8DQJGF"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>



<nav class="navbar navbar-light">
    <div class="container d-block">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-map-marker"></i>
            GoWisata.
        </a>
    </div>
</nav>

<div id="main-content">

    @if (empty($cart) || count($cart) == 0)

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
                                <table class="table table-hover" id="cart">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $grandtotal = 0; ?>
                                        @foreach ($cart as $key => $cart)
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
                                                    {{ $cart['jumlah'] }}
                                                </td>
                                                {{-- <td>
                                        {{ $cart["durasi"]}} Hari
                                    </td> --}}

                                                {{-- <td>
                                        {{ $cart["tanggal_a"]}} -  {{ $cart["tanggal_b"]}}
                                    </td> --}}


                                                <td>
                                                    Rp. {{ number_format($subtotal) }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('/cart/hapus/' . $key) }}"> Batal </a>
                                                </td>


                                            </tr>
                                            <?php $grandtotal += $subtotal;
                                            ?>
                                        @endforeach
                                        <tr>
                                            <th colspan="5"> Grand Total </th>
                                            <th> Rp. {{ number_format($grandtotal) }}
                                            <th> </th>
                                        </tr>


                                    </tbody>
                                </table>
                                <form action="{{ url('/transaksi/tambah') }} " method="POST"
                                    enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                    <div class="col-12  d-flex justify-content-end mb-5">
                                        <div class="form-group">
                                            <label for="last-name-column">Ingin Pesan untuk tanggal berapa ?</label>
                                            {{-- <input class="form-control" id="datefield" name="checkin" type="date" /> --}}
                                            <input type="date" class="form-control" id="datefield" name="date"
                                                class="form-control @error('date') is-invalid @enderror" required>
                                            {{-- <input type="text" id="last-name-column" class="form-control"
                                        placeholder="Last Name" name="lname-column"> --}}
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        {{-- <button type="submit" class="btn btn-primary me-1 mb-1" name="action"
                                            value="epay"> Bayar via E-pay
                                        </button> --}}
                                        <button type="submit" id="pay-button" class="btn btn-primary me-1 mb-1"
                                            name="action" value="transfer"> Bayar via transfer bank
                                        </button>

                                        {{-- <button type="submit" class="btn btn-primary me-1 mb-1" name="action"
                                            value="langsung"> Bayar ditempat
                                        </button> --}}
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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

    {{-- <form id="payment-form" method="post" action="snapfinish">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" name="result_type" id="result-type" value=""></div>
    <input type="hidden" name="result_data" id="result-data" value=""></div>
  </form> --}}



    {{-- <script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // Snaptoken acquired

        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');
        function changeResult(type,data){
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));

        }
        snap.pay('<?= $snapToken ?>',{

            onSuccess: function(result){
            ochangeResult('success',result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();

            },
            onPending: function(result){
            changeResult('pending',result);
            console.log(result.status_message);
            $("#payment-form").submit();

            },
            onError: function(result){
            changeResult('error',result);
            console.log(result.status_message);
            $("#payment-form").submit();

            }
        });
    }
</script> --}}

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
