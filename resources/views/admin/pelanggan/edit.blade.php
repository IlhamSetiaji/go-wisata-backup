@extends('admin.layouts2.master')
@section('title', 'Edit Pelanggan')



@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    {{-- <h3>List Admin</h3> --}}
</div>
<div class="page-content">
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{route('pelanggan.update',[$users->id])}} " method="POST" enctype="multipart/form-data">
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
                                            <label>Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        placeholder="Password" >
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Info Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal"  method="POST" enctype="multipart/form-data">

                                <div class="form-body">
                                    <div class="row">
                                        {{-- <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                        alt="singleminded"> --}}

                                        <div class="col-mt-8">
                                        {{-- <img alt="image"class="card-img-top img-fluid" width="50" src="{{asset('images')}}/{{$users->image}}"> --}}
                                        </div>
                                        <div class="col-md-4">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    <input disabled type="name" class="form-control" name="name"
                                                        placeholder="Name" id="name" value="{{ $users->name }}" required>

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
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    <input disabled type="email" class="form-control" name="email"
                                                        placeholder="Email" id="email" value="{{ $users->email }}" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mobile</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    <input disabled type="text" class="form-control" id="telp" name="telp"
                                                        placeholder="Mobile" value="{{ $users->telp}}" >


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="" name="telp"
                                                        placeholder="{{ $users->jk}}"  disabled value="" >


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    <input disabled type="text" class="form-control" id="" name="telp"
                                                        placeholder="{{ $users->alamat}}" value="" >


                                                </div>
                                            </div>
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
