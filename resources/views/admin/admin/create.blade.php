@extends('admin.layouts2.master')
@section('title', 'Tambah Admin')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    @foreach ($errors->all() as $error)
        {!! Toastr::error($error, 'Error', ['options']) !!}
    @endforeach


    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Admin</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data admin</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Admin</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form action="{{ route('admin.store') }} " method="POST" enctype="multipart/form-data"
                                    class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>PetugasID</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <div class="form-control-icon">
                                                            <i class="fas fa-id-badge"></i>
                                                        </div>

                                                        <input type="name" class="form-control" id="petugas_id"
                                                            name="petugas_id" value="{{ $petugas_id }}" disabled required>
                                                        <input type="text" name="petugas_id" value="{{ $petugas_id }}"
                                                            hidden>
                                                        {{-- <input type="text" class="form-control" id="disabledInput" name="petugas_id" --}}
                                                        {{-- value="{{ $users }}" disabled> --}}


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Name *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" placeholder="Name" id="first-name-icon"
                                                            value="{{ old('name') }}" required>

                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="Email" id="first-name-icon"
                                                            value="{{ old('email') }}" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Password *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="6 characters" value="{{ old('password') }}"
                                                            required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-lock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Image *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input class="form-control @error('image') is-invalid @enderror"
                                                            name="image" type="file" id="image" multiple=""
                                                            required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person-square"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <label>Jenis Kelamin *</label>
                                            </div>

                                            <div class="col-md-6 ">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="jk" required>
                                                                <option value="">Please select jk</option>
                                                                <option value="pria">Pria</option>
                                                                <option value="wanita">Wanita</option>

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
                                                            placeholder="Mobile" value="{{ old('telp') }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Alamat *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                                        <div class="form-control-icon">
                                                            <i class="far fa-map"></i>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Role *</label>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="role_id" id="role">
                                                                <option selected value=''>Please select role</option>
                                                                @if (auth()->user()->role_id == 1)
                                                                    @foreach (App\Models\Role::where('name', '!=', 'pelanggan')->get() as $role)
                                                                        <option value="{{ $role->id }}"> Admin
                                                                            {{ $role->name }}</option>
                                                                    @endforeach
                                                                @else
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->id }}"> Admin
                                                                            {{ $role->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (auth()->user()->role_id == 1)
                                                <div id="livin" style="display: none">
                                                    <div class="col-md-4">
                                                        <label>Province *</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" name="province_id"
                                                                        id="province" required>
                                                                        <option selected value="">Please select
                                                                            province
                                                                        </option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province->id }}">
                                                                                {{ $province->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>City *</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" name="city"
                                                                        id="city" required>
                                                                        <option label="&nbsp;"></option>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
    </div>
    </section>
    <!-- Hoverable rows end -->
    <a class=" nav-link" href="{{ route('admin.index') }}"> <span>List Admin</span></a>

    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $('#role').on('change', () => {
                let roleId = $('#role').val();
                console.log(roleId);
                if (roleId == 9) {
                    document.getElementById('livin').style.display = 'block';
                } else {
                    document.getElementById('livin').style.display = 'none';
                }
            })
            /*------------------------------------------
            --------------------------------------------
            Province dropdown change event
            --------------------------------------------
            --------------------------------------------*/
            $('#province').on('change', function() {
                let idProvince = this.value;
                $("#district").html('');
                $.ajax({
                    url: "{{ url('api/fetch-cities') }}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        // document.getElementById('province_name').value = $(
                        //     "#province option:selected").text();
                        $('#city').html(
                            '<option value="">-- Select City --</option>');
                        $.each(result, function(key, value) {
                            $("#city").append('<option value="' + value
                                .nama + '">' + value.nama + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
