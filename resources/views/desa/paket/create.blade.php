
@extends('admin.layouts2.master')
@section('title', 'Tambah Paket')


@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}
@foreach ($errors->all() as $error)
{!!  Toastr::error($error, 'Error', ['options']) !!}
@endforeach
{{-- <link rel="stylesheet" href="assets/vendors/toastify/toastify.css"> --}}
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/vendors/quill/quill.bubble.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/quill/quill.snow.css') }}">


<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Tempat</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Tempat</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tempat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                        <h5 class="card-title">General</h5>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                            <form action="{{ route('paketd.created')}} " method="POST"  class="form form-vertical">
                                    @csrf
                                <div class="form-body">
                                    <div class="row">


                                        <div class="col-md-4">
                                            <label for="first-name-icon">Nama Paket</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="nama_paket"
                                                        placeholder="Name" id="first-name-icon" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-people"></i>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Kategori</label>
                                        </div>
                                        {{-- <div class="col-md-6 mb-4"> --}}
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" name="id_kategori" required>
                                                            <option value="" >Pilih Kategori</option>
                                                            @foreach ($kategori as $kategori)
                                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </fieldset>

                                                </div>
                                            </div>
                                        </div>
                                    
                                      
                                        <div class="col-md-4">
                                            <label>Desa</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect"  name="id_desa">

                                                            <option selected value=''>Pilih Desa</option>
                                                            @foreach($desa as $desa)
                                                                <option value="{{$desa->id}}">{{$desa->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    
                                                    </fieldset>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Jumlah Orang</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="jml_orang">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Jumlah Hari</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="jml_hari">
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-4">
                                            <label>Harga Paket</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="harga">
                                                </div>
                                            </div>
                                        </div>

                                     </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1">Submit</button>
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

</div>

<script src="{{ asset('assets/vendors/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-editor.js') }}"></script>

<script src="{{asset('assets/js/new_tempat.js')}}"></script>
@endsection


