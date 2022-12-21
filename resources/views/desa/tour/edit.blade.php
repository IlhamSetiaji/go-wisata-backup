@extends('admin.layouts2.master')
@section('title', 'Edit Tour Guide')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
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
                    <h3>Data Tour Guide</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data Tour Guide</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tourd.index') }}">Tour Guide</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="page-content">
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Tour Guide</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('tourd.update', [$users->id]) }} "
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="name" class="form-control" name="name"
                                                                placeholder="Name" id="name"
                                                                value="{{ $users->name }}" required>
                                                        </div>
                                                    </div>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Desa Penugasan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                            class="form-control @error('id_desa') is-invalid @enderror"
                                                            value="{{ $dataDesa->tempat->name }}" required readonly>
                                                        <input type="text"
                                                            class="form-control"
                                                            name='desa_id' value="{{ $dataDesa->tempat_id }}" required hidden>
                                                    {{-- <select class="form-select" aria-label="Default select example" name="desa_id">
                                                        <option selected>Desa Penugasan</option>
                                                            <option value="{{ $users->desa_id }}">{{ $users->desa_id }}</option>
                                                      </select> --}}
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label>Telfon</label>
                                                </div>
                                                <div class="col-md-8 mt-2">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="number" class="form-control @error('telp') is-invalid @enderror" id="telp"
                                                                name="telp" placeholder="Telfon"
                                                                value="{{ $users->telp }}">
                                                            @error('telp')
                                                                <div class="invalid-feedback">{{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                                                placeholder="Email" id="email"
                                                                value="{{ $users->email }}" required>
                                                                @error('email')
                                                                <div class="invalid-feedback">{{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Image</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">
                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle"
                                                                    width="50"
                                                                    src="{{ asset($users->foto) }}">
                                                            </div>
                                                            <input type="file"
                                                                class="form-control file-upload-info @error('foto') is-invalid @enderror"
                                                                placeholder="Upload Image" name="foto">
                                                                @error('foto')
                                                                <div class="invalid-feedback">{{ $message }} </div>
                                                            @enderror
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Harga</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                                                name="harga" placeholder="Harga"
                                                                value="{{ $users->harga }}">
                                                                @error('foto')
                                                                <div class="invalid-feedback">{{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Update</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('tourd.index') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Back</a>
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

    @endsection
