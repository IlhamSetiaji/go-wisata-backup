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

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            {{-- <a href="index.html"><i class="bi bi-chevron-left"></i></a> --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-map-marker"></i>
                GoWisata.
            </a>
        </div>
    </nav>

    <div id="main-content">

        <div class="container">
            <h4 class="card-title">
                <ul class="pagination pagination-primary  justify-content-center">
                    Order di {{ $tiket->tempat->name }}
                </ul>
            </h4>
            <div class="row">
                <div class="card mt-5 col-md-4">
                </div>
                <div class="card mt-5 col-md-6">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="pagination pagination-primary">
                                            <label>Order ID</label>
                                        </ul>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $tiket->kode }}
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jumlah Bayar</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        Rp. {{ $result->gross_amount }}
                                    </div>

                                    <div class="col-md-4">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-md-8 form-group ">
                                        @if ($statuse == 'settlement')
                                            Sudah Dibayar
                                        @endif
                                        @if ($statuse == 'expire')
                                            Expire
                                        @endif
                                        @if ($statuse == 'pending')
                                            Belum Dibayar
                                        @endif
                                        @if ($statuse == 'cancel')
                                            Cancel
                                        @endif
                                    </div>
                                    @if ($statuse == 'settlement')
                                        <div class="col-md-4">
                                            <label>Waktu Pembayaran</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            {{ $setelmen_timee }}
                                        </div>
                                    @elseif ($statuse == 'pending')
                                        @if ($result->payment_type == 'bank_transfer')
                                            <div class="col-md-4">
                                                <label>Bank </label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                {{ $bank }}
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nomor VA </label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                {{ $va_number }}
                                            </div>
                                        @endif
                                        @if ($result->payment_type == 'qris')
                                        @endif
                                        <div class="col-md-4">
                                            <label>Deadline </label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            {{ $deadline }}
                                        </div>
                                    @elseif ($statuse == 'expire')
                                    @else
                                    @endif
                                    <div class="col-md-4">
                                        <label>Waktu Pembelian </label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        {{ $transaction_time }}
                                    </div>
                                    <div class="col-12 col-md-8 offset-md-4 form-group">

                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-5 col-md-2">
                </div>
            </div>
        </div>

        <div class="col-md-10 ">
            <div clas="card">

                <form action="{{ route('payment.store') }} " method="POST" enctype="multipart/form-data"
                    class="form form-horizontal">
                    @csrf
                    <input type="hidden" name="id" value="{{ $transaction_id }}">
                    <input type="hidden" name="status_message" value="{{ $transaction_status }}">
            </div>
            <input type="hidden" name="order_id" value="{{ $result->order_id }}">
        </div>
        <input type="hidden" name="payment_type" value="{{ $result->payment_type }}">
    </div>
    <input type="hidden" name="transaction_time" value="{{ $transaction_time }}"></div>
    <input type="hidden" name="transaction_status" value="{{ $statuse }} "></div>
    <input type="hidden" name="va_number" value="{{ $va_number }}"></div>
    <input type="hidden" name="va_bank" value="{{ $bank }}"></div>
    <input type="hidden" name="kodeku" value="{{ $kode }}"></div>
    <ul class="pagination pagination-primary justify-content-center">
        <button type="submit" class="btn btn-primary me-1 mb-1">Okay</button>
    </ul>
    </form>


    </div>
    </div>
    </div>

    <nav aria-label="Page navigation example">

    </nav>











</body>

<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('assets/js/main.js') }}"></script>


</html>
