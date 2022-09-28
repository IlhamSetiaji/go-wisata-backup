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
    {!! Toastr::message() !!}

    <div class="container">
        <div class="card mt-5">

            <div class="card-body">

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title breadcrumb breadcrumb-center"> Paket Camping</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ url('/pilihcamping/' . $id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Nama</label>
                                                        <input type="text" id="first-name-column"
                                                            class="form-control" placeholder="{{ Auth::user()->name }}"
                                                            name="name" value="{{ Auth::user()->name }}" disabled>
                                                        <input type="hidden" id="first-name-column"
                                                            class="form-control" placeholder="{{ Auth::user()->name }}"
                                                            name="name" value="{{ Auth::user()->name }}">
                                                        <input type="hidden" id="first-name-column"
                                                            class="form-control" placeholder="{{ Auth::user()->name }}"
                                                            name="user_id" value="{{ Auth::user()->id }}">
                                                        {{-- <input type="hidden" id="first-name-column" class="form-control" placeholder="{{ $kode }}" name="kode" value="{{ $kode }}" > --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Check In</label>
                                                        <input type="date" class="form-control" id="datefield"
                                                            name="date"
                                                            class="form-control @error('date') is-invalid @enderror"
                                                            required>
                                                        {{-- <input type="text" id="last-name-column" class="form-control"
                                                            placeholder="Last Name" name="lname-column"> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Check Out</label>
                                                        <input type="date" class="form-control" id="datefield2"
                                                            name="date2"
                                                            class="form-control @error('date') is-invalid @enderror"
                                                            required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tempat</label>
                                                        <input type="text" id="city-column" class="form-control"
                                                            name="tempat_id" value="{{ $tempat->name }}" disabled>
                                                        <input type="hidden" id="city-column" class="form-control"
                                                            name="tempat_id" value="{{ $tempat->id }}">
                                                        <input type="hidden" id="city-column" class="form-control"
                                                            name="tempat_name" value="{{ $tempat->name }}">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Tenda</label>

                                                        <fieldset class="form-group">
                                                            <select class="form-select"  name="alat_id">

                                                                <option selected value='0'>Sewa Tenda / Tidak</option>
                                                                <option selected value='0'>Tidak Sewa</option>
                                                                @foreach (App\Models\Camp::where('tempat_id', $tempat->id)->where('kategori', 'alat')->get() as $alat)
                                                                    <option value="{{$alat->kode_camp}}">  {{$alat->name}}, {{ $alat->deskripsi_harga }} {{ $alat->harga }}</option>

                                                                @endforeach

                                                            </select>

                                                        </fieldset>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">JumlahTenda</label>
                                                        <input type="number" id="city-column" class="form-control"
                                                            placeholder="Jumlah Tenda" name="jumlah_tenda" >

                                                        </div>
                                                </div> --}}
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Jumlah Orang</label>
                                                        <input type="number" id="country-floating"
                                                            class="form-control" name="jumlah_orang"
                                                            placeholder="Jumlah Orang" min="0" required>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Durasi Sewa Tenda </label>

                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder=""
                                                                    aria-label="durasi"  name="durasi"
                                                                    aria-describedby="basic-addon2" min="0">
                                                                <span class="input-group-text" id="basic-addon2">/Hari</span>
                                                            </div>

                                                    </div>
                                                </div> --}}

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Makan</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="makan" required>
                                                                <option value="">Inlude / Exclude</option>
                                                                {{-- <option value="include">Include @ Rp {{ number_format(App\Models\Camp::where('tempat_id',$tempat->id )->where('kategori','makan')->pluck('harga')->first())  }}</option> --}}
                                                                <option value="include">Include</option>
                                                                <option value="exclude">Exclude</option>

                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Pesan Makan untuk Berapa Hari</label>
                                                        <input type="number" id="country-floating" class="form-control"
                                                        name="makan_durasi" placeholder="Durasi ? 1 hari 3 x makan">
                                                    </div>
                                                </div> --}}

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1"> Pesan
                                                    </button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- <form action="{{ route('pesan.camping')}} " method="POST" enctype="multipart/form-data" class="form form-horizontal">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Nama</label>
                                                        <input type="text" id="first-name-column" class="form-control" placeholder="{{ Auth::user()->name }}" name="name" value="{{ Auth::user()->name }}" disabled>
                                                        <input type="hidden" id="first-name-column" class="form-control" placeholder="{{ Auth::user()->name }}" name="name" value="{{ Auth::user()->name }}" >
                                                        <input type="hidden" id="first-name-column" class="form-control" placeholder="{{ Auth::user()->name }}" name="user_id" value="{{ Auth::user()->id }}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Check In</label>
                                                        <input type="date" class="form-control" id="datefield"  name="date"
                                                            class="form-control @error('date') is-invalid @enderror" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Check Out</label>
                                                        <input type="date" class="form-control" id="datefield2"  name="date"
                                                            class="form-control @error('date') is-invalid @enderror" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tempat</label>
                                                        <input type="text" id="city-column" class="form-control"
                                                            name="tempat_id" value="{{ $tempat->name}}"  disabled>
                                                        <input type="hidden" id="city-column" class="form-control" name="tempat_id" value="{{ $tempat->id}}"  >
                                                        <input type="hidden" id="city-column" class="form-control" name="tempat_name" value="{{ $tempat->name }}"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Tenda</label>

                                                        <fieldset class="form-group">
                                                            <select class="form-select"  name="alat_id">

                                                                <option selected value='0'>Sewa Tenda / Tidak</option>
                                                                <option selected value='0'>Tidak Sewa</option>
                                                                @foreach (App\Models\Camp::where('tempat_id', $tempat->id)->where('kategori', 'alat')->get() as $alat)
                                                                    <option value="{{$alat->kode_camp}}">  {{$alat->name}}, {{ $alat->deskripsi_harga }} {{ $alat->harga }}</option>

                                                                @endforeach

                                                            </select>

                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">JumlahTenda</label>
                                                        <input type="number" id="city-column" class="form-control"
                                                            placeholder="Jumlah Tenda" name="jumlah_tenda" >

                                                        </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Jumlah</label>
                                                        <input type="number" id="country-floating" class="form-control"
                                                            name="jumlah_orang" placeholder="Jumlah Orang"  min="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Durasi Sewa Tenda </label>

                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder=""
                                                                    aria-label="durasi"  name="durasi"
                                                                    aria-describedby="basic-addon2" min="0">
                                                                <span class="input-group-text" id="basic-addon2">/Hari</span>
                                                            </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Makan</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select"  name="makan" required>
                                                                <option value="" >Inlude / Exclude</option>
                                                                <option value="include">Include</option>
                                                                <option value="exclude">Exclude</option>

                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Pesan Makan untuk Berapa Hari</label>
                                                        <input type="number" id="country-floating" class="form-control"
                                                        name="makan_durasi" placeholder="Durasi ? 1 hari 3 x makan">
                                                    </div>
                                                </div>


                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1"> Pesan </button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
                <nav class="navbar navbar-light">
                    <div class="container d-block">

                        <button class="btn btn-secondary rounded-pill" onclick="goBack()" class=""><i
                                class="bi bi-chevron-left"></i> Back</button>

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
