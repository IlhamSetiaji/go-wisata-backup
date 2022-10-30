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

                                <form action="{{ route('admin.store') }}" id="form" method="POST"
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
                                                            name="id_desa" placeholder="Nama paket wisata"
                                                            value="{{ $dataDesa->name }}" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah Orang</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="jmlh_orang"
                                                            id="jmlh_orang" value="{{ old('jmlh_orang') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah Hari</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="jmlh_hari"
                                                            id="jmlh_hari" value="{{ old('jmlh_hari') }}" required>
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
                                                            <select class="form-select" name="data-wisata" id="data-wisata" required>
                                                                <option value="">Please select data wisata</option>
                                                                @foreach ($dataWisatas as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->name }}
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
                                                            <select class="form-select" name="data-wahana" id='data-wahana'
                                                                required>
                                                                <option value="">Please select data Wahana</option>
                                                                @foreach ($dataWahanas as $data)
                                                                    <option value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Penginapan</label>
                                            </div>
                                            <div class="col-md-8" id="penginapan">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="data-penginapan"
                                                                id='data-penginapan' required>
                                                                <option value="">Please select data Penginapan
                                                                </option>
                                                                @foreach ($dataPenginapans as $data)
                                                                    <option value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Total</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="harga"
                                                            id="harga-total" value="{{ old('harga') }}" required
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
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
                            $('#wahana').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data-wahana" id = "data-wahana" required>  <option value = "" > Please select data Wahana </option>@foreach ($dataWahanas as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select> </fieldset> </div> </div>'));
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
                                $('#wisata').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data-wisata" id = "data-wisata" required>  <option value = "" > Please select data Wisata </option>@foreach ($dataWisatas as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select> </fieldset> </div> </div>'));
                                    }
                                });

                            $(document).on('change', '#data-penginapan', function() {
                            var allGood = true;
                            // var lastInputField = ;
    
                            if ($(this).val() == "") {
                                console.log('false');
                                return allGood = false;
                            }
                            if (allGood) {
                                $('#penginapan').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data-wisata" id = "data-wisata" required>  <option value = "" > Please select data Wisata </option>@foreach ($dataPenginapans as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select> </fieldset> </div> </div>'));
                                    }
                                });
                        });
                    
    </script>
@endsection
