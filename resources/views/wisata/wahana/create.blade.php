@extends('admin.layouts2.master')
@section('title','Wisata')
@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-content">
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class=" col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Wahana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                                <form action="{{ route('wahana.store')}} " method="POST" enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Wahana ID</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-id-badge"></i>
                                                    </div>

                                                    <input type="name" class="form-control"  name="kode_wahana" value="{{ $wahana_id }}" disabled required>
                                                    <input type="text" name="kode_wahana" value="{{ $wahana_id }}" hidden>
                                                        {{-- <input type="text" class="form-control" id="disabledInput" name="petugas_id" --}}
                                                            {{-- value="{{ $users }}" disabled> --}}


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tempat Wisata</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select"  name="tempat_id">

                                                            <option selected value=''>Pilih tempat wisata</option>
                                                            {{-- @foreach(App\Models\Role::where('name','!=','pelanggan')->get() as $role)
                                                                <option value="{{$role->id}}"> Admin {{$role->name}}</option>
                                                            @endforeach --}}
                                                            @foreach($tempat as $key=>$tempat)
                                                            <option value="{{$tempat->id}}">  {{$tempat->name}}</option>

                                                            @endforeach

                                                        </select>
                                                        {{-- <div class="form-control-icon">
                                                            <i class="bi bi-exclude"></i>
                                                        </div> --}}
                                                    </fieldset>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Nama Wahana</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                                        placeholder="Nama Wahana" id="first-name-icon" value="{{ old('name') }}" required>

                                                    <div class="form-control-icon">
                                                        <i class="far fa-map"></i>
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
                                                    <textarea class="form-control"  name="deskripsi"
                                                    rows="3" required></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="far fa-file-alt"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Desc Harga</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <textarea class="form-control"  name="deskripsi_harga"
                                                    rows="3" required></textarea>
                                                    <div class="form-control-icon">
                                                        <i class="far fa-file-alt"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <label>Image</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" multiple="" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-square"></i>
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
                                                    <input type="number" class="form-control" name="harga"
                                                        placeholder="Harga" value="{{ old('harga')}}">
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </div>
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
        </div>
    </section>
    <!-- Hoverable rows end -->
    <a class=" nav-link" href="{{ route('wahana.index') }}"><i class="fas fa-gamepad"></i><span> List Wahana</span></a>

</div>
@endsection
