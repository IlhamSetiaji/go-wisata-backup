@extends('admin.layouts2.master')
@section('title', 'Kuliner')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}


    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-content">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images') }}/{{ Auth::user()->image }}" class="d-block w-100"
                                    alt="Photo 400 x 600 px">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images') }}/{{ Auth::user()->image }}" class="d-block w-100"
                                    alt="Photo 2200 x 1280 px">
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
                        <form class="form form-horizontal" action="{{route('profile.update',[Auth::user()->id])}}
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
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

                        </form>
                        <a href="{{ url('/crop-image-upload') }}" class="nav__link">Crop 400 x 600 Foto1</a>
                        <!--Basic Modal -->
                        <div class="modal fade text-left" id="password" tabindex="-1" aria-labelledby="myModalLabel1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Update Password</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form form-horizontal"
                                            action="{{route('profile.update3',[Auth::user()->id])}}" method="POST"
                                            enctype="multipart/form-data">
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
                                                                <input type="password" class="form-control"
                                                                    name="current_password">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Password Baru</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control"
                                                                    name="new_password">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Konfirmasi Password Baru</label>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="password" class="form-control"
                                                                    name="new_confirm_password">

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

                </div>
            </div>
        </div>
    </div>


@endsection
