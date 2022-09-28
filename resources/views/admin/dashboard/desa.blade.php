@extends('admin.layouts2.master')
@section('title', 'Admin Page')
{{-- @section('page', 'Dashboard ') --}}


@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}
@foreach ($errors->all() as $error)
{!!  Toastr::error($error, 'Error', ['options']) !!}
@endforeach
<link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Data Statistics</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('desa.index') }}">
                    <div class="card" >
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Tempat</h6>
                                    <h6 class="font-extrabold mb-0"> {{App\Models\Tempat::where('induk_id', $tempat->id)->count()}} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('admind.index') }}">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Petugas</h6>
                                    <h6 class="font-extrabold mb-0">{{App\Models\User::where('role_id', '!=', 5)->where('desa_id',$tempat->id)->count()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-12 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Uang Total</h6>
                                    <h6 class="font-extrabold mb-0">Rp. {{ number_format(App\Models\Tempat::where('induk_id', $tempat->id)->sum('dana')) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 col-md-6">
                    <a href="{{ route('desa.index') }}">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Desa </h6>
                                    <h6 class="font-extrabold mb-0">{{ $tempat->name }} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('rekapd.index')}}">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="far fa-file"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Rekap</h6>
                                    <h6 class="font-extrabold mb-0">Data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>




        </div>
        <div class="col-12 col-lg-3">
            <div class="card" data-bs-toggle="modal" data-bs-target="#default">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            {{-- <img src="{{ URL::to('/images/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->avatar }}"> --}}
                            <img alt="Face 1" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{ Auth::user()->image}}">
                            {{-- <img src="assets/images/faces/1.jpg" alt="Face 1"> --}}
                        </div>
                        <div class="ms-3 name">
                            {{-- <h5 class="font-bold">{{ Auth::user()->name }}</h5> --}}
                            <h5 class="font-bold">Profile</h5>
                            {{-- <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- user profile modal --}}
            <div class="card-body">
                 <!--Basic Modal -->
        <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Update Profile</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form form-horizontal" action="{{route('profile.update',[Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" >
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
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
                                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" >
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis Kelamin</label>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <fieldset class="form-group">

                                                <select class="form-select"  name="jk" required>
                                                    <option value=""    @if (Auth::user()->jk== null) selected @endif >Please select jk</option>
                                                    <option value="pria"  @if (Auth::user()->jk== "pria") selected @endif >Pria</option>
                                                    <option value="wanita"  @if (Auth::user()->jk== "wanita") selected @endif>Wanita</option>

                                                </select>
                                            </fieldset>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Mobile</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="number" class="form-control" name="telp" value="{{ Auth::user()->telp }}" >
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">

                                            @if (auth()->user()->status == 1)
                                            <input type="text" class="form-control" value="Active"  readonly >
                                            @else
                                            <input type="text" class="form-control" value="Inactive"  readonly >
                                            @endif

                                            <div class="form-control-icon">
                                                <i class="fas fa-user-cog"></i>
                                                {{-- <i class="bi bi-bag-check"></i> --}}
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
                                            <input type="text" class="form-control" name="alamat" value="{{ Auth::user()->alamat }}" >
                                            <div class="form-control-icon">

                                                <i class="far fa-map"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">

                                    <a data-bs-toggle="modal" data-bs-target="#password"> <button class="btn btn-outline-secondary me-1 mb-1">Ganti Password </button></a>
                                    <button type="submit"
                                        class="btn btn-outline-primary me-1 mb-1">Update</button>
                                    {{-- <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--Basic Modal -->
        <div class="modal fade text-left" id="password" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Update Password</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form form-horizontal" action="{{route('profile.update3',[Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Password Lama</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" name="current_password"  >

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Password Baru</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" name="new_password"  >

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Konfirmasi Password Baru</label>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" name="new_confirm_password">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit"
                                        class="btn btn-outline-primary me-1 mb-1">Update</button>
                                    {{-- <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
            </div>


    </section>

      <a  href="{{ route('password.request') }}" > <button class="btn btn-outline-warning me-1 mb-1">Lupa Password </button></a>

</div>

@endsection
