
@extends('admin.layouts2.master')
@section('title', 'Tambah Tempat')


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

                                <form action="{{ route('tempat.stored')}} " method="POST" enctype="multipart/form-data" class="form form-vertical">
                                    @csrf
                                <div class="form-body">
                                    <div class="row">


                                        <div class="col-md-4">
                                            <label for="first-name-icon">Nama Tempat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                                        placeholder="Name" id="first-name-icon" value="{{ old('name') }}" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-people"></i>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <label for="first-name-icon">Slug</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                                        placeholder="slug" id="slug" value="{{ old('slug') }}" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-people"></i>
                                                        </div>

                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-4">
                                            <label for="first-name-icon">Deskripsi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                                        placeholder="deskripsi" id="first-name-icon" value="{{ old('deskripsi') }}" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-people"></i>
                                                        </div>

                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-4">
                                            <label>Kategori</label>
                                        </div>
                                        {{-- <div class="col-md-6 mb-4"> --}}
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" name="kategori" required>
                                                            <option value="" >Pilih Kategori</option>
                                                            <option value="wisata"> Tempat Wisata</option>
                                                            <option value="hotel"> Tempat Penginapan</option>
                                                            <option value="kuliner"> Tempat Kuliner</option>


                                                        </select>
                                                    </fieldset>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Deskripsi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control" name="deskripsi"
                                                        value="{{ old('deskripsi')}}" >

                                                    </textarea>
                                                    <div class="form-control-icon">
                                                    <i class="fas fa-pen"></i>
                                                    </div>

                                                </div>

                                                </div>

                                        </div>



                                        <div class="col-md-4">
                                            <label>Image (400x600 p)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" multiple="" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Image (2200x1280 p)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input class="form-control @error('image2') is-invalid @enderror" name="image2" type="file" id="image2" multiple="" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Email" id="first-name-icon" value="{{ old('email') }}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Mobile</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" name="telp"
                                                        placeholder="Mobile" value="{{ old('telp')}}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control" name="alamat"
                                                    rows="3" required ></textarea>
                                                    <div class="form-control-icon">
                                                    <i class="far fa-map"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Petugas</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect"  name="user_id" >

                                                            <option selected value=''>Pilih Petugas</option>
                                                            @foreach(App\Models\User::where('role_id','!=','5')->where('desa_id',$tempat->id)->where('tempat_id',null)->get() as $role)
                                                                <option value="{{$role->petugas_id}}"> Admin - {{$role->name}}</option>
                                                            @endforeach

                                                        </select>
                                                        {{-- <div class="form-control-icon">
                                                            <i class="bi bi-exclude"></i>
                                                        </div> --}}
                                                    </fieldset>

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
    <!-- Hoverable rows end -->
    <a class=" nav-link" href="{{ route('tempat.index') }}"><span>List Tempat</span></a>

</div>

<script src="{{ asset('assets/vendors/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-editor.js') }}"></script>

<script src="{{asset('assets/js/new_tempat.js')}}"></script>
@endsection


