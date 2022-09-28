@extends('pesanan.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    <div id="main-content">

        <div class="container">


            @foreach ($errors->all() as $error)
                {!! Toastr::error($error, 'Error', ['options']) !!}
                {{-- <p class="text-danger">{{ $error }}</p> --}}
            @endforeach
            <div class="row">
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#default2">
                        <div class="card-content">
                            @if (Auth::user()->image == null)
                                {{-- <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/user.jpg"> --}}
                                <img src="{{ asset('images') }}/user.jpg" class="card-img-top img-fluid" alt="singleminded">
                            @else
                                <img src="{{ asset('images') }}/{{ Auth::user()->image }}" class="card-img-top img-fluid"
                                    alt="singleminded">
                            @endif

                            {{-- <div class="card-body">
                <h5 class="card-title">{{ Auth::user()->name }}</h5>

            </div> --}}
                        </div>
                        {{-- Dibuat tanggal : {{ substr(App\Models\User::pluck('created_at')->first(),0,10) }} </li> --}}


                    </div>


                </div>
                <div class="col-md-5">
                    <div class="card-content">

                        <div class="card" data-bs-toggle="modal" data-bs-target="#default">
                            <div class="card-header">
                                <h4 class="card-title">Profile</h4>
                                {{-- Akun dibuat tanggal :  {{ substr(App\Models\User::pluck('created_at')->first(),0,10) }} --}}
                            </div>

                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    {{ ucfirst(Auth::user()->name) }}

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    {{ Auth::user()->email }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    @if (Auth::user()->jk == null)
                                                        Kosong
                                                    @else
                                                        {{ ucfirst(Auth::user()->jk) }}
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    @if (Auth::user()->alamat == null)
                                                        Kosong
                                                    @else
                                                        {{ ucfirst(Auth::user()->alamat) }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telepon</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    {{ ucfirst(Auth::user()->telp) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <a data-bs-toggle="modal" data-bs-target="#password"> <button
                                                    class="btn btn-outline-secondary me-1 mb-1">Ganti Password </button></a>
                                            <button type="submit" class="btn btn-primary me-1 mb-1" data-bs-toggle="modal"
                                                data-bs-target="#default">Update</button>
                                            {{-- <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <button type="submit"
    class="btn btn-outline-primary me-1 mb-1"  data-bs-toggle="modal" data-bs-target="#default3"><i class="fas fa-key"></i> Ganti Password</button> --}}


                    </div>


                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ url('/pesananku') }}">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <br>
                                {{-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold"><b>Saldo</b></h6>
                                        <h6 class="font-extrabold mb-0">

                                            @if (Auth::user()->balance == null)
                                                0
                                            @else
                                                Rp. {{ number_format(Auth::user()->balance) }}
                                            @endif
                                        </h6>
                                    </div>

                                </div>
                                <br> --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pilih Pembayaran</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('status', 0)->count() }}
                                        </h6>
                                    </div>

                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-spinner"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pending</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('check', 'pending')->count() }}
                                        </h6>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Cancel</h6>
                                        <h6 class="font-extrabold mb-0"> <?php $cancel =
                                            App\Models\Tiket::where('user_id', Auth::user()->id)
                                                ->where('check', 'cancel')
                                                ->count() +
                                            App\Models\Tiket::where('user_id', Auth::user()->id)
                                                ->where('check', 'expire')
                                                ->count(); ?> {{ $cancel }}</h6>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Berhasil</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ App\Models\Tiket::where('user_id', Auth::user()->id)->where('check', 'settlement')->count() }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>


                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"> <button class="btn btn-outline-warning me-1 mb-1">Lupa
                            Password </button></a>
                @endif

            </div>
            {{-- user profile modal --}}
            <div class="card-body">
                <!--Basic Modal -->
                <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Update Profile</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal"
                                    action="{{ route('profile.update', [Auth::user()->id]) }}" method="POST"
                                    enctype="multipart/form-data">
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
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ Auth::user()->name }}">
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
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ Auth::user()->email }}">
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

                                                            <select class="form-select" name="jk" required>
                                                                <option value=""
                                                                    @if (Auth::user()->jk == null) selected @endif>Pilih
                                                                    gender</option>
                                                                <option value="pria"
                                                                    @if (Auth::user()->jk == 'pria') selected @endif>Pria
                                                                </option>
                                                                <option value="wanita"
                                                                    @if (Auth::user()->jk == 'wanita') selected @endif>Wanita
                                                                </option>

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
                                                        <input type="number" class="form-control" name="telp"
                                                            value="{{ Auth::user()->telp }}">
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
                                                            <input type="text" class="form-control" value="Active"
                                                                readonly>
                                                        @else
                                                            <input type="text" class="form-control" value="Inactive"
                                                                readonly>
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
                                                        <input type="text" class="form-control" name="alamat"
                                                            value="{{ Auth::user()->alamat }}">
                                                        <div class="form-control-icon">

                                                            <i class="far fa-map"></i>
                                                        </div>
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
                                    <span class="d-none d-sm-block">Back</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="default2" tabindex="-1" aria-labelledby="myModalLabel1"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Update Image</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal"
                                    action="{{ route('profile.update2', [Auth::user()->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Image</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="file"
                                                            class="form-control file-upload-info @error('image') is-invalid @enderror" " placeholder="Upload Image" name="image">
                                                            <span class="input-group-append">
                                                <div class="form-control-icon">
                                                    <i class="fas fa-images"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-outline-primary me-1 mb-1">Update</button>

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
            {{-- <div class="modal fade text-left" id="default3" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
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
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password Lama"  required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Password Baru</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="password" class="form-control" name="password2"
                                            placeholder="Password Baru" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Konfirmasi Password Baru</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="password" class="form-control" name="password3"
                                            placeholder="Konfirmasi Password Baru" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                    class="btn btn-outline-primary me-1 mb-1">Update</button>

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
    </div> --}}
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
                    <form class="form form-horizontal" action="{{ route('profile.update3', [Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
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
@endsection
