@extends('admin.layouts2.master')
@section('title', 'Edit Setting')



@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Setting</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola gambar halaman depan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Setting</a></li>
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
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{route('setting.update',[$setting->id])}} " method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="name" class="form-control" name="nama"
                                                                placeholder="Name" id="name" value="{{ $setting->nama }}" required>
                                                            <div class="form-control-icon">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }} </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Ref</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">
                                                            <input type="name" class="form-control" name="ref"
                                                                placeholder="Ref" id="ref" value="{{ $setting->ref }}" >
                                                            <div class="form-control-icon">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }} </div>
                                                    @enderror
                                                </div>



                                                <div class="col-md-4">
                                                    <label>Image</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$setting->image}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  " placeholder="Upload Image" name="image">
                                                            <span class="input-group-append">
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
                                            <a  href="{{ route('setting.index') }}"
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
