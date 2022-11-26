@extends('admin.layouts2.master')
@section('title', 'Tambah Paket')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    @foreach ($errors->all() as $error)
        {!! Toastr::error($error, 'Error', ['options']) !!}
    @endforeach


    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Paket</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data paket</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('budget.index') }}">Paket</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ dd($dataDesa) }} --}}
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Paket</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form action="{{ route('budget.detail.create') }}" id="form" method="GET"
                                    enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Name Paket</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('nama_paket') is-invalid @enderror"
                                                            name="nama_paket" placeholder="Nama paket wisata"
                                                            value="{{ old('nama_paket') }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Desa</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('id_desa') is-invalid @enderror"
                                                            placeholder="Nama paket wisata"
                                                            value="{{ $dataDesa->tempat->name }}" required readonly>
                                                        <input type="text"
                                                            class="form-control"
                                                            name='id_desa' value="{{ $dataDesa->tempat_id }}" required hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Kategori</label>
                                            </div>
                                            <div class="col-md-8 ">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            {{-- <select class="form-select" name="id_kategori" required>
                                                                <option value="" >Pilih Kategori</option>
                                                                @foreach ($kategoriPakets as $kategori)
                                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori}}</option>
                                                                @endforeach
                                                                
                                                            </select> --}}
                                                            @foreach ($kategoriPakets as $kategori)
                                                                <input class="form-check-input" type="checkbox" value="{{ $kategori->id }}" id="flexCheckDefault" name="kategori[]">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                  {{ $kategori->nama_kategori }}
                                                                </label>
                                                            @endforeach
                                                        </fieldset>
    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah Orang</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="jml_orang"
                                                            id="jml_orang" value="1" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah Hari</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="jml_hari"
                                                            id="jml_hari" value="1" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Wisata</label>
                                            </div>
                                            <div class="col-md-8" id="wisata">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="data_wisata[]" id="data-wisata">
                                                                <option value="">Please select data wisata</option>
                                                                @foreach ($dataWisatas as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->name }} - {{ $data->htm != ''? $data->htm : 'Rp. 0' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Wahana</label>
                                            </div>
                                            <div class="col-md-8" id="wahana">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="data_wahana[]" id='data-wahana'>
                                                                <option value="">Please select data Wahana</option>
                                                                @foreach ($dataWahanas as $data)
                                                                    <option value="{{ $data->id }} ">
                                                                        {{ $data->name }} - {{ $data->harga != ''? $data->harga : 'Rp. 0' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Kuliner</label>
                                            </div>
                                            <div class="col-md-4" id="restoran">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="resto" id='resto'>
                                                                <option value="">Please select Restoran</option>
                                                                @foreach ($dataKuliners as $data)
                                                                    <option value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="paketrestoran">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="paketresto" id='paketresto'>
                                                                <option value="">Pilih paket dari restoran</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Penginapan</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div id="hotel">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" name="data_penginapanhotel"
                                                                    id='data-penginapan-hotel'>
                                                                    <option value="">Pilih Hotel
                                                                    </option>
                                                                    @foreach ($dataPenginapanHotel as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" name="kamar"
                                                                    id='kamar'>
                                                                    <option value="">Pilih Kamar
                                                                    </option>
                                                                    {{-- @foreach ($dataPenginapanHotel as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->nama }}
                                                                        </option>
                                                                    @endforeach --}}
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-8">
                                                <div id="villa">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" name="data_penginapanvilla[]"
                                                                    id='data-penginapan-villa'>
                                                                    <option value="">Pilih villa
                                                                    </option>
                                                                    @foreach ($dataPenginapanVilla as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->nama }} - {{ $data->harga }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{-- <div class="col-md-4">
                                                <label>Total</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="harga"
                                                            id="harga-total" value="{{ old('harga') }}" 
                                                            required>
                                                    </div>  
                                                </div>
                                            </div> --}}
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- Hoverable rows end -->

    </div>

    <script>
        $(document).ready(function() {
                    $(document).on('change', '#data-wahana', function() {
                        var allGood = true;
                        // var lastInputField = ;

                        if ($(this).val() == "") {
                            console.log('false');
                            return allGood = false;
                        }
                        if (allGood) {
                            $('#wahana').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_wahana[]" id = "data-wahana">  <option value = "" > Please select data Wahana </option>@foreach ($dataWahanas as $data)<option value="{{ $data->id }}" >{{ $data->name }}- {{ $data->harga != ''? $data->harga : "Rp. 0" }} </option>@endforeach</select> </fieldset> </div> </div>'));
                        }
                    });
                    

                    $(document).on('change', '#data-wisata', function() {
                        var allGood = true;
                        // var lastInputField = ;
    
                        if ($(this).val() == "") {
                            console.log('false');
                            return allGood = false;
                        }
                            
                        if (allGood) {
                            $('#wisata').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_wisata[]" id = "data-wisata" >  <option value = "" > Please select data Wisata </option>@foreach ($dataWisatas as $data)<option value="{{ $data->id }}">{{ $data->name }} - {{ $data->htm != ''? $data->htm : "Rp. 0" }}</option>@endforeach</select> </fieldset> </div> </div>'));
                        }
                    });
                    // $(document).on('change', '#paketresto', function() {
                    //     var allGood = true;
                    //     // var lastInputField = ;
    
                    //     if ($(this).val() == "") {
                    //         console.log('false');
                    //         return allGood = false;
                    //     }
                            
                    //     if (allGood) {
                    //         $('#paketrestoran').append($('<div class="form-group"><div class="position-relative"><fieldset class="form-group"><select class="form-select" name="paketresto" id="paketresto"><option value="">Pilih paket dari restoran</option><option value="$data->id> $data->nama_paket - $data->harga</option></select></fieldset></div></div>'));
                    //     }
                    // });

                    // $(document).on('change', '#data-penginapan-hotel', function() {    
                    //     var allGood = true;
                    //     // var lastInputField = ;
                    //     if ($(this).val() == "") {
                    //         console.log('false');
                    //         return allGood = false;    
                    //     }    
                    //     if (allGood) {    
                    //         $('#hotel').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_penginapanhotel[]" id = "data-penginapan-hotel">  <option value = "" > Pilih Hotel </option>@foreach ($dataPenginapanHotel as $data)<option value="{{ $data->id }}">{{ $data->nama }}</option>@endforeach</select> </fieldset> </div> </div>'));
                    //     }    
                    // });
                    // $(document).on('change', '#data-penginapan-villa', function() {
                    //     var allGood = true;    
                    //     // var lastInputField = ;
                    //     if ($(this).val() == "") {
                    //         console.log('false');
                    //         return allGood = false;
                    //     }
                    //     if (allGood) { 
                    //         $('#villa').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_penginapanvilla[]" id = "data-penginapan-villa">  <option value = "" > Pilih Villa </option>@foreach ($dataPenginapanVilla as $data)<option value="{{ $data->id }}">{{ $data->nama }} - {{ $data->harga }}</option>@endforeach</select> </fieldset> </div> </div>'));            
                    //     }
                    // }); 
                });
    </script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {
                $('#resto').on('change', function() {
                    let resto = $('#resto').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-data-menu') }}",
                        data: {
                            resto_id: resto
                        },
                        cache: false,

                        success: function(msg) {
                            // console.log(msg);
                            $('#paketresto').html(msg);
                        },
                        error: function(data) {
                            console.log('error: ', data)
                        }
                    });
                })
            })
        });
    </script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {
                $('#data-penginapan-hotel').on('change', function() {
                    let hotel = $('#data-penginapan-hotel').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-data-kamar') }}",
                        data: {
                            hotel_id: hotel
                        },
                        cache: false,

                        success: function(msg) {
                            console.log(msg);
                            $('#kamar').html(msg);
                        },
                        error: function(data) {
                            console.log('error: ', data)
                        }
                    });
                })
            })
        });
    </script>
@endsection
