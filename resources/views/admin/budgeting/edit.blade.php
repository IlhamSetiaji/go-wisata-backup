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
    {{-- {{ dd($resto->dataPaketKuliner->tempat) }} --}}
    {{-- {{ dd($dataKuliner) }} --}}

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
                                <form action="{{ '/budgeting-edit/'. $paket->id . '/detail' }}" id="form" method="POST"
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
                                                            @foreach ($kategoriChecklist as $checklist)
                                                            <input class="form-check-input forms-select" type="checkbox" value="{{ $checklist->id }}" id="flexCheckDefault" name="kategori[]" checked disabled>
                                                            <label class="form-check-label" for="flexCheckDefault"> 
                                                                {{ $checklist->nama_kategori }}
                                                            </label>
                                                            @endforeach
                                                            @foreach ($kategoriNonChecklist as $nonChecklist)
                                                            <input class="form-check-input forms-select" type="checkbox" value="{{ $nonChecklist->id }}" id="flexCheckDefault" name="kategori[]" disabled>
                                                            <label class="form-check-label" for="flexCheckDefault"> 
                                                                {{ $nonChecklist->nama_kategori }}
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
                                                <label>Tour Guide</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div id="hotel">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select forms-select" name="guide" disabled>
                                                                    @if ($guide != null)
                                                                    <option value="">Hapus Tour Guide</option>
                                                                        @foreach ($dataGuide as $item)
                                                                            @if ($guide == $item->id)
                                                                            <option value="{{ $item->id }}" selected> {{ $item->name }} - {{ $item->harga }}</option>
                                                                            
                                                                            @else
                                                                            <option value="{{ $item->id }}"> {{ $item->name }} - {{ $item->harga }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        @foreach ($dataGuide as $item)
                                                                            <option value="">Pilih Tour Guide</option>
                                                                        <option value="{{ $item->id }}"> {{ $item->name }} - {{ $item->harga }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </fieldset>
                                                        </div>
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
                                                                        <option value="">Hapus Wisata
                                                                        </option>
                                                                            @if ($wisata->tempat->id == $data->id)
                                                                                <option value="{{ $data->id }}"
                                                                                    selected>{{ $data->name }} - {{ $data->htm }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $data->id }}">
                                                                                    {{ $data->name }} - {{ $data->htm }} </option>
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
                                                                            {{ $data->name }} - {{ $data->htm }}
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
                                            @foreach ($idPenginapan as $id)
                                                <input type="text" name="idPenginapan[]" value="{{ $id->id }}" hidden>
                                            @endforeach
                                            <div class="col-md-4">
                                                <div id="hotel">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select forms-select" name="data_penginapanhotel"
                                                                    id='data-penginapan-hotel' disabled>
                                                                    @if ($hotel != null)
                                                                    <option value="">Hapus Hotel</option>
                                                                        @foreach ($dataHotels as $item)
                                                                            @if ($item->id == $hotel->id)
                                                                                <option value="{{ $item->id }}" selected> {{ $item->nama }}</option>
                                                                            @else
                                                                                <option value="{{ $item->id }}"> {{ $item->nama }}</option>
                                                                            @endif

                                                                        @endforeach
                                                                    @else
                                                                        <option value=""> Pilih Hotel </option>
                                                                        @foreach ($dataHotels as $item)
                                                                            <option value="{{ $item->id }}"> {{ $item->nama }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                   
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <fieldset class="form-group ">
                                                                <select class="form-select forms-select" name="kamar"
                                                                    id='kamar' disabled>
                                                                    @if ($kamar != null)
                                                                        @foreach ($dataKamar as $item)
                                                                            @if ($item->id == $kamar->id)
                                                                                <option value="{{ $item->id }}" selected>  {{ $item->name }} - {{ $item->harga }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $item->id }}">  {{ $item->name }} - {{ $item->harga }}
                                                                                </option>
                                                                            @endif
                                                                            @endforeach
                                                                    @else
                                                                    <option value=""> Pilih hotel terlebih dahulu
                                                                    </option>
                                                                    @endif
                                                                   
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
                                                                <select class="form-select forms-select" name="data_penginapanvilla"
                                                                    id='data-penginapan-villa' disabled>
                                                                    @if ($villa != null)
                                                                    <option value="">Hapus Villa
                                                                            </option>
                                                                        @foreach ($dataVilla as $item)
                                                                            @if ($item->id == $villa->id)
                                                                                <option value="{{ $item->id }}" selected>{{ $item->nama }}-{{ $item->harga }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $item->id }}">{{ $item->nama }}-{{ $item->harga }}
                                                                                </option>
                                                                        @endif
                                                                            @endforeach
                                                                    @else
                                                                    <option value=""> Pilih Villa
                                                                    </option>
                                                                       @foreach ($dataVilla as $item)
                                                                            <option value="{{ $item->id }}">{{ $item->nama }}-{{ $item->harga }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                    
                                                                </select>
                                                            </fieldset>
                                                        </div>
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
                                                            <select class="form-select forms-select" name="resto" id='resto' disabled>
                                                                @if ($dataKuliners != null && $resto != null)
                                                                    @foreach ($dataKuliners as $data)
                                                                        @if ($resto->dataPaketKuliner->tempat->id == $data->id)
                                                                        <option value="">Hapus Restoran</option>
                                                                            <option value="{{ $data->id }}" selected>
                                                                                    {{ $data->name }}
                                                                            </option>
            
                                                                        @else
                                                                            <option value="{{ $data->id }}">
                                                                                {{ $data->name }}
                                                                            </option>
                                                                        @endif

                                                                    @endforeach
                                                                    <input type="text" name="id_paketkuliner" value="{{ $resto->id }}" hidden>
                                                                @else
                                                                <option value=""> Pilih Resto
                                                                </option>
                                                                    @foreach ($dataKuliners as $data)
                                                                    <option value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- {{ dd($paketMenu->) }} --}}
                                            {{-- {{ dd($menus) }}
                                            {{ dd($menus[0]->id == $paketMenu->id) }} --}}
                                            <div class="col-md-4" id="paketrestoran">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select forms-select" name="paketresto" id='paketresto' disabled>
                                                                @if ($menus != null && $paketMenu != null)
                                                                    @foreach ($menus as $menu)
                                                                        @if ($menu->id == $paketMenu->data_paket_kuliner_id)
                                                                            
                                                                        <option value="{{ $menu->id }}" selected>{{ $menu->nama_paket }} - {{ $menu->harga }} </option>
                                                                        @else
                                                                        {{-- <option value=""> Hapus Menu
                                                                        </option> --}}
                                                                        <option value="{{ $menu->id }}">{{ $menu->nama_paket }} - {{ $menu->harga }} </option>
                                                                            
                                                                        @endif
                                                                    @endforeach
                                                                    @else
                                                                    <option value=""> Pilih Resto terlebih dahulu
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </fieldset>
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
