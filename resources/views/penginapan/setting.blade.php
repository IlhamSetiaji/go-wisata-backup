@extends('admin.layouts2.master')
@section('title','Penginapan')
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

<div class="row">
<div class="col-md-6">

            <div class="card">
                <div class="card-content">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item  active">
                                <img src="{{asset('images')}}/{{$tempat->image2}}" class="d-block w-100"
                                    alt="Photo 2200 x 1280 px">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images')}}/{{$tempat->image}}" class="d-block w-100"
                                    alt="Photo 400 x 600 px">
                            </div>

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $tempat->name }}</h4>
                        <p class="card-text">
                            {{ $tempat->alamat}}
                        </p>

                        <p class="card-text">

                        </p>
                        @if($tempat->open== 1)
                        <a href="{{route('update.status.tempat.penginapan',[$tempat->id])}}"><button class="btn btn-warning"> Buka</button></a>
                        @else
                        <a href="{{route('update.status.tempat.penginapan',[$tempat->id])}}"><button class="btn btn-danger"> Tutup</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
<div class="col-md-5">
    <div class="card-content">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail</h4>
            </div>

                <div class="card-body">



                    <form class="form form-horizontal" action="{{route('update.data.tempat.penginapan',[$tempat->id])}} " method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Name aa</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="name" class="form-control" name="name"
                                            placeholder="Name" id="name" value="{{ $tempat->name }}" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email" id="email" value="{{ $tempat->email }}" required>
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
                                        <input type="text" class="form-control" id="telp" name="telp"
                                            placeholder="Mobile" value="{{ $tempat->telp}}" >

                                        <div class="form-control-icon">
                                            <i class="bi bi-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Photo</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-lefts">
                                    <div class="position-relative">
                                        <div class="form-control-icon avatar avatar.avatar-im">
                                            <img src="{{asset('images')}}/{{$tempat->image}}">
                                        </div>
                                        <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  " placeholder="Upload Image" name="image">
                                        <span class="input-group-append">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Photo 2 </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-lefts">
                                    <div class="position-relative">
                                        <div class="form-control-icon avatar avatar.avatar-im">
                                            <img src="{{asset('images')}}/{{$tempat->image2}}">
                                        </div>
                                        <input type="file" class="form-control file-upload-info @error('image2') is-invalid @enderror"  " placeholder="Upload Image" name="image2">
                                        <span class="input-group-append">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Alamat</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Alamat"  value="{{ $tempat->alamat }}"  >
                                        <div class="form-control-icon">
                                            <i class="far fa-map"></i>
                                        </div>
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

                    </div>

                </form>
                <a href="{{ url('/crop-image-upload') }}" class="nav__link">Crop 400 x 600 Foto1</a>
                </div>

        </div>
    </div>
</div>
</div>


@endsection
