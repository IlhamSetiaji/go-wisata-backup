<!DOCTYPE html>
<html lang="en">

<head>


    <title>GoWisata. -Booking </title>
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

<body>
    {!! Toastr::message() !!}

    <div class="container">
        <div class="card mt-5">

            <div class="card-body">
                {{-- {{ dd($penginapan) }} --}}
                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title breadcrumb breadcrumb-center"> Reservasi </h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('pesan.kamar') }} " method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input class="form-control" type="text" value="{{ $tempat_name }}"
                                                disabled>
                                            <input class="form-control" type="text"
                                                value=" Kamar {{ $kamar_id }}" disabled>
                                            <input class="form-control" type="text"
                                                value="{{ $checkin }} - {{ $checkout }}" disabled>
                                            <input class="form-control" type="text"
                                                value=" Jumlah Orang {{ $jumlah_orang }}" disabled>
                                            {{-- <input class="form-control"   type="text" value="{{ $tempat->name }}" disabled> --}}
                                            <input class="form-control" name="tempat_id" type="hidden"
                                                value="{{ $tempat_id }}">
                                            <input class="form-control" name="tempat_name" type="hidden"
                                                value="{{ $tempat_name }}">
                                            <input class="form-control" name="kamar_id" type="hidden"
                                                value="{{ $kamar_id }}">
                                            <input class="form-control" name="jumlah_kamar" type="hidden"
                                                value="{{ $jumlah_kamar }}">
                                            <input class="form-control" name="checkin" type="hidden"
                                                value="{{ $checkin }}">
                                            <input class="form-control" name="checkout" type="hidden"
                                                value="{{ $checkout }}">
                                            <input class="form-control" name="jumlah_orang" type="hidden"
                                                value="{{ $jumlah_orang }}">
                                            <input class="form-control" name="durasi" type="hidden"
                                                value="{{ $durasi }}">

                                            <button type="submit" class="btn btn-primary me-1 mb-1">Booking</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
                <nav class="navbar navbar-light">
                    <div class="container d-block">

                        <button onclick="goBack()" class=""><i class="bi bi-chevron-left"></i> Back</button>

                    </div>
                </nav>
            </div>
        </div>
    </div>


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
    var dateToday = new Date();
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            showButtonPanel: true,
            numberOfMonths: 2,
            minDate: dateToday,
        });
    });
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
