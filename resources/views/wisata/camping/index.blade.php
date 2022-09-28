@extends('admin.layouts2.master')
@section('title','Camp')
@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Camping</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Camping</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item">    <a href="{{route('camping.create')}}" class="btn btn-outline-primary "> <i class="fas fa-plus"></i>Tambah data </a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-right">

            {{-- <li class="breadcrumb-item">    <a href="{{route('camp.create')}}" class="btn btn-outline-primary "> <i class="fas fa-plus"></i>Tambah camp </a></li> --}}

        </ol>
    </nav>
</div>
@if(count($camp)>0)
@foreach($camp as $key=>$camp)

<div class="row">
<div class="col-md-6">

            <div class="card">
                <div class="card-content">
                    <img class="card-img-top img-fluid" src="{{asset('images')}}/{{$camp->image}}"
                        alt="Card image cap" style="height: 20rem" />

                    <div class="card-body">
                        <h4 class="card-title">{{ $camp->name }}</h4>
                        {{ $camp->deskripsi }}

                        <small class="breadcrumb breadcrumb-right"  >
                            @if($camp->harga==0)
                            Free
                            @else
                            <a class="btn disabled  btn-outline-primary" href="#" >Harga/Hari: Rp. {{ $camp->harga}}</a>

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
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        @if($camp->status==1)
                        <a href="{{route('update.status.camp',[$camp->id])}}"><button class="btn btn-warning"> Active</button></a>
                        @else
                        <a href="{{route('update.status.camp',[$camp->id])}}"><button class="btn btn-danger"> Inactive</button></a>
                        @endif
                    </ol>
                </nav>
            </div>

                <div class="card-body">



                    <form class="form form-horizontal" action="{{route('camping.update',[$camp->id])}} " method="POST" enctype="multipart/form-data">
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
                                            placeholder="Name" id="name" value="{{ $camp->name }}" required>
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
                                <label>Photo</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-lefts">
                                    <div class="position-relative">
                                        {{-- <div class="form-control-icon avatar avatar.avatar-im">
                                            <img src="{{asset('images')}}/{{$users->image}}">
                                        </div> --}}
                                        <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  " placeholder="Upload Image" name="image">
                                        <span class="input-group-append">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Deskripsi </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                            placeholder="deskripsi"  value="{{ $camp->deskripsi }}"  >
                                        <div class="form-control-icon">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label>Harga</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="harga" name="harga"
                                            placeholder="harga"  value=" {{ ( $camp->harga) }}"  >
                                        <div class="form-control-icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-mb-4">
                                <br>
                            </div>



                            <div class="col-12 d-flex ">
                                <button type="submit"
                                    class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>

                    </div>

                </form>
                <form class="forms-sample col-12 d-flex justify-content-end" action="{{route('camping.destroy',[$camp->id])}}" method="post" >
                    @csrf
                    @method('DELETE')

                        <button type="submit" class="btn bt-danger"    onclick="return confirm('Are you sure to want to delete it?')"><i class="bi bi-trash"></i></span> </button>


                </form>

                </div>

        </div>
    </div>
</div>
</div>
@endforeach
@else
<div class="card">
    <div class="card-body">
    Tidak ada Alat Camp di tempat ini, silahkan menambahkan alat camp :)
    <div class="card-body">
</div>
@endif



@endsection
