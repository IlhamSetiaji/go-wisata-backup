@extends('admin.layouts2.master')
@section('title', 'Edit Paket')


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
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Paket</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('update-paket') }}" id="form" method="POST"
                                    enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Name Paket</label>
                                            </div>
                                            <input type="text" name="id" id="" value="{{ $paket->id }}"
                                                hidden>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('nama_paket') is-invalid @enderror forms"
                                                            name="nama_paket" placeholder="Nama paket wisata"
                                                            value="{{ old('nama_paket', $paket->nama_paket) }}" readonly
                                                            required>
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
                                                            value="{{ $dataDesa->name }}" required readonly>
                                                        <input type="text" class="form-control" name='id_desa'
                                                            value="{{ $dataDesa->tempat_id }}" required hidden>
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
                                                            <select class="form-select forms-select" name="id_kategori"
                                                                required disabled>
                                                                <option value="">Pilih Kategori</option>
                                                                @foreach ($kategoriPakets as $kategori)
                                                                    <option
                                                                        {{ $paket->id_kategori == $kategori->id ? 'selected' : '' }}
                                                                        value="{{ $kategori->id }}">
                                                                        {{ $kategori->nama_kategori }}</option>
                                                                @endforeach
                                                            </select>
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
                                                        <input type="text" class="form-control forms" name="jml_orang"
                                                            id="jml_orang" value="{{ old('jml_orang', $paket->jml_hari) }}"
                                                            required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jumlah Hari</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control forms" name="jml_hari"
                                                            id="jml_hari" value="{{ old('jml_hari', $paket->jml_hari) }}"
                                                            readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Wisata</label>
                                            </div>
                                            <div class="col-md-8" id="wisata">
                                                @if (count($paketWisatas) != null)
                                                    @foreach ($paketWisatas as $wisata)
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select
                                                                        class="form-select forms-select forms-select has-icon-right"
                                                                        name="data_wisata[]" id="data-wisata" disabled>
                                                                        {{-- <span class="bi bi-trash"></span> --}}
                                                                        @foreach ($dataWisatas as $data)
                                                                            @if ($wisata->tempat->id == $data->id)
                                                                                <option value="{{ $data->id }}"
                                                                                    selected>{{ $data->name }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $data->id }}">
                                                                                    {{ $data->name }} </option>
                                                                            @endif
                                                                        @endforeach
                                                                        <input type="text" name="id_paketWisata[]"
                                                                            value="{{ $wisata->id }}" id=""
                                                                            hidden>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select forms-select"
                                                                    name="data_wisata[]" id="data-wisata" disabled>
                                                                    <option value="">Please select data Wisata
                                                                    </option>
                                                                    @foreach ($dataWisatas as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label>Wahana</label>
                                            </div>
                                            <div class="col-md-8" id="wahana">
                                                @if (count($paketWahanas) != null)
                                                    @foreach ($paketWahanas as $wahana)
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select forms-select"
                                                                        name="data_wahana[]" id='data-wahana' disabled>
                                                                        <option value="">Please select data Wahana
                                                                        </option>
                                                                        @foreach ($dataWahanas as $data)
                                                                            @if ($wahana->tempat->id == $data->id)
                                                                                <option value="{{ $data->id }}"
                                                                                    selected>
                                                                                    {{ $data->name }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $data->id }}">
                                                                                    {{ $data->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                        <input type="text" name="id_paketWahana[]"
                                                                            value="{{ $wahana->id }}" id=""
                                                                            hidden>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select forms-select"
                                                                    name="data_wahana[]" id='data-wahana' disabled>
                                                                    <option value="">Please select data Wahana
                                                                    </option>
                                                                    @foreach ($dataWahanas as $data)
                                                                        <option value="{{ $data->id }}">
                                                                            {{ $data->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label>Penginapan</label>
                                            </div>
                                            <div class="col-md-8" id="penginapan">
                                                @if (count($paketPenginapans) != null)
                                                    @foreach ($paketPenginapans as $penginapan)
                                                        <div class="form-group">
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select forms-select"
                                                                        name="data_penginapan[]" id='data-penginapan'
                                                                        disabled>
                                                                        @foreach ($dataPenginapans as $data)
                                                                            @if ($penginapan->tempat->id == $data->id)
                                                                                <option value="{{ $data->id }}"
                                                                                    selected>
                                                                                    {{ $data->name }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $data->id }}">
                                                                                    {{ $data->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                        <input type="text" name="id_paketPenginapan[]"
                                                                            va lue="{{ $penginapan->id }}" id=""
                                                                            hidden>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select forms-select"
                                                                    name="data_penginapan[]" id='data-penginapan'
                                                                    disabled>
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
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label>Total</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control forms" name="harga"
                                                            id="harga-total" value="{{ old('harga', $paket->harga) }}"
                                                            required readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button class="btn btn-warning me-1 mb-1" id="edit">Edit</button>
                                                <button type="submit" class="btn btn-primary me-1 mb-1" disabled
                                                    id="submit">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1"
                                                    id="reset" disabled>Reset</button>
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
    </div>
    <!-- Hoverable rows end -->


    <script>
        $(document).ready(function(){
            $('#edit').click(function(){
                $('.forms').removeAttr("readonly");
                $('.forms-select').removeAttr("disabled");
                $('#submit').removeAttr('disabled');
                $('#reset').removeAttr('disabled');
                $('#edit').remove();
            });
        });
    </script>
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
                            $('#wahana').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_wahana[]" id = "data-wahana">  <option value = "" > Please select data Wahana </option>@foreach ($dataWahanas as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select> </fieldset> </div> </div>'));
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
                                $('#wisata').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_wisata[]" id ="data-wisata" >  <option value = "" > Please select data Wisata </option>@foreach ($dataWisatas as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select> </fieldset> </div> </div>'));
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
                                $('#penginapan').append($(' <div class="form-group"> <div class = "position-relative"><fieldset class = "form-group"> <select class = "form-select" name = "data_penginapan[]" id = "data-penginapan">  <option value = "" > Please select data Penginapan </option>@foreach ($dataPenginapans as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select> </fieldset> </div> </div>'));
                                    }
                            });
                });
                    
    </script>
@endsection
