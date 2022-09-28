@extends('admin.layouts2.master')
@section('title','Admin - Kuliner')
@section('content')

<div class="page-content">
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class=" col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah kuliner</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                                <form action="{{ route('kuliner.store')}} " method="POST" enctype="multipart/form-data" class="form form-horizontal">
                                    @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>kuliner ID</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-id-badge"></i>
                                                    </div>

                                                    <input type="name" class="form-control"  name="kode_makanan_id" value="{{ $makanan_id }}" disabled required>
                                                    <input type="text" name="kode_kuliner" value="{{ $makanan_id }}" hidden>
                                                        {{-- <input type="text" class="form-control" id="disabledInput" name="petugas_id" --}}
                                                            {{-- value="{{ $users }}" disabled> --}}


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tempat Kuliner</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select"  name="tempat_id">

                                                            <option selected value=''>Pilih tempat Kuliner</option>
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
                                            <label>Nama Makanan/Minuman</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                                        placeholder="Nama Makanan/minuman" id="first-name-icon" value="{{ old('name') }}" required>

                                                    <div class="form-control-icon">
                                                        <i class="fas fa-utensils"></i>
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
                                            <label>Kategori</label>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <fieldset class="form-group">
                                                        <select class="form-select"  name="kategori" required>
                                                            <option value="" >Pilih Kategori</option>
                                                            <option value="makan"> Makanan </option>
                                                            <option value="minum"> Minuman</option>
                                                            <option value="snack"> Camilan</option>

                                                        </select>
                                                    </fieldset>

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
    <a class=" nav-link" href="{{ route('kuliner.index') }}"><i class="fas fa-gamepad"></i><span> List kuliner</span></a>

</div>
@endsection
