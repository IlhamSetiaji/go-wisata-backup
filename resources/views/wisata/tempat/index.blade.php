@extends('admin.layouts2.master')
@section('title','Wisata')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>




<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
{!! Toastr::message() !!}
@if(count($tempat)>0)
@foreach($tempat as $key=>$tempat)
<div class="row">
<div class="col-md-6">

            <div class="card">
                <div class="card-content">

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images')}}/{{$tempat->image2}}" class="d-block w-100"
                                    alt="400X600 PHOTO1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images')}}/{{$tempat->image}}" class="d-block w-100"
                                    alt="2200x1280 Photo2">
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
                    {{-- <img class="card-img-top img-fluid" src="{{asset('images')}}/{{$tempat->image}}"
                        alt="Card image cap" style="height: 20rem" /> --}}

                    <div class="card-body">
                        <h4 class="card-title">{{ $tempat->name }}</h4>
                        <p class="card-text">
                            {{ $tempat->alamat}}
                        </p>
                        <small class="breadcrumb breadcrumb-right"  >
                            @if($tempat->htm==0)
                            Free
                            @else
                            <a class="btn disabled  btn-outline-primary" href="#" >htm : Rp. {{ number_format($tempat->htm) }}</a>

                            @endif
                        </small>
                        <p class="card-text">

                        </p>
                        {{-- <button class="btn btn-primary block">Update now</button> --}}
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



                    <form class="form form-horizontal" action="{{route('wisata.update',[$tempat->id])}} " method="POST" enctype="multipart/form-data">
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
                                        <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  name="image">
                                        <span class="input-group-append">
                                        @error('image')
                                            {{  Toastr::error($message, 'Error', ['options']) }}
                                        @enderror
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Photo 2</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-lefts">
                                    <div class="position-relative">
                                        <div class="form-control-icon avatar avatar.avatar-im">
                                            <img src="{{asset('images')}}/{{$tempat->image2}}">
                                        </div>
                                        <input type="file" class="form-control file-upload-info @error('image2') is-invalid @enderror"   placeholder="Upload Image" name="image2">
                                        <span class="input-group-append">
                                        @error('image2')
                                            {!!  Toastr::error($message, 'Error', ['options']) !!}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Video</label>
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
                            <div class="col-md-4">
                                <label>Tiket Masuk</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="harga" name="htm"
                                            placeholder="htm"  value="{{ $tempat->htm }}"  >
                                        <div class="form-control-icon">
                                            <i class="fas fa-dollar-sign"></i>
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
                <br>

                {{-- <a href="{{ url('/video-upload') }}" class="nav__link">Video Upload</a> --}}
                {{-- <a href="{{ url('/crop-image-upload2') }}" class="nav__link">Foto 2 (2200 x 1280)</a> --}}

                </div>

        </div>
    </div>
</div>

</div>
@endforeach
@else
<td>No Data to display</td>
@endif



@endsection
