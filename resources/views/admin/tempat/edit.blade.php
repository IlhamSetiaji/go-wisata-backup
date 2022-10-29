@extends('admin.layouts2.master')
@section('title', 'Edit Tempat')



@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Tempat</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Tempat</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Tempat</a></li>
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
                        <h4 class="card-title">Edit Tempat</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{route('tempat.update',[$users->id])}} " method="POST" enctype="multipart/form-data">
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
                                                        placeholder="Name" id="name" value="{{ $users->name }}" required>
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
                                                        placeholder="Email" id="email" value="{{ $users->email }}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Deskripsi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea type="text" class="form-control" name="deskripsi"
                                                         id="deskripsi" value="{{ $users->deskripsi }}" required>
                                                    </textarea>
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-pen"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Atraksi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="atraksi"
                                                         id="deskripsi" value="{{ $users->atraksi }}" required>
                                                    
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-pen"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Akses</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="akses"
                                                         id="deskripsi" value="{{ $users->akses }}" required>
                                                    
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-pen"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Sejarah</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea type="text" class="form-control" name="sejarah"
                                                         id="deskripsi" value="{{ $users->sejarah }}" required>
                                                    </textarea>
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-pen"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Unggulan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input class="form-check-input" id="flexCheckDefault" type="checkbox" name="unggulan" value="1" 
                                                    >
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Mobile</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" id="telp" name="telp"
                                                        placeholder="Mobile" value="{{ $users->telp}}" >

                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Video Max(35mb)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-lefts">
                                                <div class="position-relative">
                                                    {{-- <div class="form-control-icon avatar avatar.avatar-im">
                                                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$users->image}}">
                                                    </div> --}}
                                                    <input type="file" class="form-control file-upload-info @error('video') is-invalid @enderror"  " placeholder="Upload Video" name="video">
                                                    <span class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Photo (400x600 p)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-lefts">
                                                <div class="position-relative">
                                                    {{-- <div class="form-control-icon avatar avatar.avatar-im">
                                                        <img src="{{asset('images')}}/{{$users->image}}">
                                                    </div> --}}
                                                    <div class="form-control-icon avatar avatar.avatar-im">
                                                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$users->image}}">
                                                    </div>
                                                    <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  " placeholder="Upload Image" name="image">
                                                    <span class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Photo (2200x1280 p)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-lefts">
                                                <div class="position-relative">
                                                    {{-- <div class="form-control-icon avatar avatar.avatar-im">
                                                        <img src="{{asset('images')}}/{{$users->image}}">
                                                    </div> --}}
                                                    <div class="form-control-icon avatar avatar.avatar-im">
                                                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$users->image2}}">
                                                    </div>
                                                    <input type="file" class="form-control file-upload-info @error('image') is-invalid @enderror"  " placeholder="Upload Image" name="image2">
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
                                                        placeholder="Alamat"  value="{{ $users->alamat }}"  >
                                                    <div class="form-control-icon">
                                                        <i class="far fa-map"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Petugas</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">

                                                        <select class="form-select" id="basicSelect"  name="user_id">
                                                        @foreach(App\Models\User::where('role_id','!=','5')->get() as $petugas)
                                                        <option value="{{$petugas->petugas_id}}" @if($petugas->petugas_id==$users->user_id) selected @endif > {{$petugas->name}}</option>
                                                        @endforeach
                                                        </select>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Induk Tempat</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect"  name="induk_id" >

                                                            <option value=""  @if($users->induk_id==null) selected @endif>  Tidak ada</option>
                                                            @foreach(App\Models\Tempat::where('kategori','desa')->get() as $induk)
                                                                <option value="{{$induk->id}}"  @if($induk->id==$users->induk_id) selected @endif>  {{$induk->name}}</option>
                                                            @endforeach

                                                        </select>
                                                        {{-- <div class="form-control-icon">
                                                            <i class="bi bi-exclude"></i>
                                                        </div> --}}
                                                    </fieldset>

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
                                    <a  href="{{ route('tempat.index') }}"
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
