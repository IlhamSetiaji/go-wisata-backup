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
                                                    <label>home1</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->home1}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('home1') is-invalid @enderror"  placeholder="Upload Image" name="home1">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>about1</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->about1}}">
                                                            </div>
                                                            <div>
                                                            <a href="{{ url('/admin/crop-about1') }}" class="nav__link"> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>about2</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->about2}}">
                                                            </div>
                                                            <div>
                                                                <a href="{{ url('/admin/crop-about2') }}" class="nav__link"> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Upload</a>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Experience1</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->experience1}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('experience1') is-invalid @enderror"   placeholder="Upload Image" name="experience1">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Experience2</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->experience2}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('experience2') is-invalid @enderror"   placeholder="Upload Image" name="experience2">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>sponsor1</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->sponsor1}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('sponsor1') is-invalid @enderror"   placeholder="Upload Image" name="sponsor1">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>sponsor2</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->sponsor2}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('sponsor2') is-invalid @enderror"   placeholder="Upload Image" name="sponsor2">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>sponsor3</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->sponsor3}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('sponsor3') is-invalid @enderror"   placeholder="Upload Image" name="sponsor3">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>sponsor4</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">

                                                            <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images/setting')}}/{{$setting->sponsor4}}">
                                                            </div>
                                                            <input type="file" class="form-control file-upload-info @error('sponsor4') is-invalid @enderror"   placeholder="Upload Image" name="sponsor4">
                                                            <span class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Video (max:35mb)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group has-icon-lefts">
                                                        <div class="position-relative">
                                                            {{-- <div class="form-control-icon avatar avatar.avatar-im">
                                                                <img src="{{asset('images')}}/{{$users->image}}">
                                                            </div> --}}
                                                            <input type="file" class="form-control file-upload-info @error('video') is-invalid @enderror"   placeholder="Upload Video" name="video">
                                                            <span class="input-group-append">
                                                            @error('video')
                                                                {!!  Toastr::error($message, 'Error', ['options']) !!}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>




                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Update</button>
                                                    {{-- <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
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
@endsection
