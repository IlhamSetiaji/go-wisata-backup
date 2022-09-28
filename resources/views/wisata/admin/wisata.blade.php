@extends('admin.layouts2.master')
@section('title','Sub Tempat')
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
                <h3>Data Tempat yang ada </h3>
                <p class="text-subtitle text-muted">Halaman yang menunjukan tempat -tempat yang ada</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">

                        {{-- <li class="breadcrumb-item">    <a href="{{route('camping.create')}}" class="btn btn-outline-primary "> <i class="fas fa-plus"></i>Tambah Alat Camp </a></li> --}}
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
<div class="row">
@if(count($kuliner)>0)
@foreach($kuliner as $key=>$kuliner)
<div class="col-xl-4 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-content">
            <img src="{{asset('images')}}/{{$kuliner->image}}" class="card-img-top img-fluid"
                alt="singleminded">
            <div class="card-body">
                <h5 class="card-title">{{ $kuliner->name }}</h5>
                <p class="card-text">
                   {{$kuliner->deskripsi}}
                </p>
            </div>
        </div>
        <ul class="list-group list-group-flush">

            <li class="list-group-item"> Petugas : {{$kuliner->petugas->name}}</li>

        </ul>
        <div class="card-footer d-flex justify-content-between">
            <span></span>

                @if($kuliner->status==1)
                <a href="{{route('update.status.atwkuliner',[$kuliner->id])}}"><button class="btn btn-warning"> Active</button></a>
                @else
                <a href="{{route('update.status.atwkuliner',[$kuliner->id])}}"><button class="btn btn-danger"> Inactive</button></a>
                @endif

            </button>
        </div>
    </div>


</div>


@endforeach
</div>
@else
<td>No user to display</td>
@endif

@endsection
