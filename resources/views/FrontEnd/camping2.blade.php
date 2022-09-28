<!DOCTYPE html>
<html lang="en">

<head>


    <title>GoWisata. -Camp </title>
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
    <nav class="navbar navbar-light">
        <div class="container d-block">

            <button class="btn btn-secondary rounded-pill" onclick="goBack()" class=""><i
                    class="bi bi-chevron-left"></i> Kembali</button>

        </div>
    </nav>
    {!! Toastr::message() !!}

    <div class="container">
        <div>
            <h4 class="card-title breadcrumb breadcrumb-center"> Mau Sewa Tenda ? </h4>
        </div>
        <div class="row">

            @foreach ($cekalat as $key => $ca)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <img src="{{ asset('images') }}/{{ $ca->image }}" class="card-img-top img-fluid"
                                alt="singleminded">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ca->name }}</h5>
                                <p class="card-text">
                                    {{ $ca->deskripsi }} Rp. {{ number_format($ca->harga) }}
                                    {{ $ca->deskripsi_harga }}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <small class="breadcrumb breadcrumb-right">
                                <?php
                                date_default_timezone_set('Asia/Jakarta');
                                
                                if ($formatted_dt1 > $formatted_dt2) {
                                    $durasi = -1 * $formatted_dt1->diffInDays($formatted_dt2);
                                } else {
                                    $durasi = $formatted_dt1->diffInDays($formatted_dt2);
                                }
                                for ($i = 0; $i < $durasi; $i++) {
                                    $eventtgl = date('Y-m-d ', strtotime('+' . $i . 'day', strtotime($checkin)));
                                    // dd($eventtgl);
                                    $booked = App\Models\EventCamping::where('date', $eventtgl)
                                        ->where('tempat_id', $tempat_id)
                                        ->where('title', 'booked')
                                        ->where('camp_id', $ca->kode_camp)
                                        ->exists();
                                }
                                //   dd($booked)
                                ?>

                                {{-- @if (App\Models\EventCamping::where('date', $eventtgl)->where('tempat_id', $tempat_id)->where('title', 'booked')->where('camp_id', $ca->kode_camp)->exists()) --}}
                                @if ($booked == true)
                                    <button class="btn disabled  btn-outline-primary" href="#">Booked</button>
                                @else
                                    <form action="{{ url('/cart/tambah/camp/' . $ca->kode_camp) }} " method="GET"
                                        enctype="multipart/form-data">
                                        @csrf


                                        <input type="hidden" id="first-name-column" class="form-control" name="durasi"
                                            value="{{ $durasi }}">
                                        <input type="hidden" id="first-name-column" class="form-control"
                                            name="tempat_id" value="{{ $tempat_id }}">
                                        <input type="hidden" id="first-name-column" class="form-control"
                                            name="tanggal_a" value="{{ $formatted_dt1 }}">
                                        <input type="hidden" id="first-name-column" class="form-control"
                                            name="tanggal_b" value="{{ $formatted_dt2 }}">

                                        <button class="btn btn-warning" type="submit"> Booking</button>

                                    </form>
                                @endif
                            </small>



                        </div>
                    </div>
                </div>



                <br>
            @endforeach
        </div>
        @isset($makan)
            <br>
            <h4 class="card-title breadcrumb breadcrumb-center"> Pilih Paket Makan </h4>
            {{-- <div class="container"> --}}
            <div class="row">
                @foreach ($makan as $key => $ca)
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <img src="{{ asset('images') }}/{{ $ca->image }}" class="card-img-top img-fluid"
                                    alt="singleminded">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $ca->name }}</h5>
                                    <p class="card-text">
                                        {{ $ca->deskripsi }} Rp. {{ number_format($ca->harga) }}
                                        {{ $ca->deskripsi_harga }}

                                    </p>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">

                                {{-- <li class="list-group-item"> Petugas : {{$kuliner->petugas->name}}</li> --}}

                            </ul>
                            <div class="card-footer d-flex justify-content-between">
                                <span></span>
                                <small class="breadcrumb breadcrumb-right">

                                    <?php
                                    
                                    date_default_timezone_set('Asia/Jakarta');
                                    
                                    if ($formatted_dt1 > $formatted_dt2) {
                                        $durasi = -1 * $formatted_dt1->diffInDays($formatted_dt2);
                                    } else {
                                        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
                                    }
                                    for ($i = 0; $i < $durasi; $i++) {
                                        $eventtgl = date('Y-m-d ', strtotime('+' . $i . 'day', strtotime($checkin)));
                                    }
                                    ?>
                                    @if (App\Models\EventCamping::where('date', $eventtgl)->where('tempat_id', $tempat_id)->where('title', 'booked')->where('camp_id', $ca->kode_camp)->exists())
                                        <a class="btn disabled  btn-outline-primary" href="#">Booked</a>
                                    @else
                                        <div class="tab-para">

                                            <form action="{{ url('/cart/tambah/camp/' . $ca->kode_camp) }} " method="GET"
                                                enctype="multipart/form-data">
                                                @csrf


                                                <input type="hidden" id="first-name-column" class="form-control"
                                                    name="durasi" value="{{ $durasi }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                    name="tempat_id" value="{{ $tempat_id }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                    name="tanggal_a" value="{{ $formatted_dt1 }}">
                                                <input type="hidden" id="first-name-column" class="form-control"
                                                    name="tanggal_b" value="{{ $formatted_dt2 }}">

                                                <button class="btn btn-warning" type="submit"> Booking</button>

                                            </form>
                                    @endif
                                </small>


                            </div>
                        </div>
                    </div>
            </div>
            @endforeach

        </div>
    @endisset



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
