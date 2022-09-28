@extends('admin.layouts2.master')
@section('title', 'Kamar')
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
                    <h3>Data Kamar</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data Kamar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a data-bs-toggle="modal" data-bs-target="#create"
                                    class="btn btn-outline-primary "> <i class="fas fa-plus"></i>Tambah Kamar</a></li>

                            {{-- <li class="breadcrumb-item"> <a href="{{ route('kamar.create') }}"
                                    class="btn btn-outline-primary "> <i class="fas fa-plus"></i>Tambah Kamar</a></li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-right">

            </ol>
        </nav>
    </div>
    @if (!count($kamar) > 0)
        <div class="card">
            <div class="card-body">
                Tidak ada kamar di tempat ini, silahkan menambahkan kamar :)
                <div class="card-body">
                </div>
            @else
                @foreach ($kamar as $key => $kamar)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <img class="card-img-top img-fluid" src="{{ asset('images') }}/{{ $kamar->image }}"
                                        alt="Card image cap" style="height: 20rem" />

                                    <div class="card-body">
                                        <h4 class="card-title">{{ $kamar->name }}</h4>
                                        <p align="justify">
                                            {{ $kamar->deskripsi }}
                                        </p>

                                        <small class="breadcrumb breadcrumb-right">
                                            @if ($kamar->harga == 0)
                                                Free
                                            @else
                                                <a class="btn disabled  btn-outline-primary" href="#">harga: Rp.
                                                    {{ number_format($kamar->harga) }}</a>
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
                                        <h4 class="card-title">Detail kamar</h4>
                                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                            <ol class="breadcrumb">
                                                @if ($kamar->status == 1)
                                                    <a href="{{ route('update.status.kamar', [$kamar->id]) }}"><button
                                                            class="btn btn-warning"> Active</button></a>
                                                @else
                                                    <a href="{{ route('update.status.kamar', [$kamar->id]) }}"><button
                                                            class="btn btn-danger"> Inactive</button></a>
                                                @endif
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="card-body">
                                        <form class="form form-horizontal"
                                            action="{{ route('kamar.update', [$kamar->id]) }} " method="POST"
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
                                                                <input type="name" class="form-control" name="name"
                                                                    placeholder="Name" id="name"
                                                                    value="{{ $kamar->name }}" required>
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
                                                                <input type="file"
                                                                    class="form-control file-upload-info @error('image') is-invalid @enderror"
                                                                    placeholder="Upload Image" name="image">
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
                                                                <input type="text" class="form-control" id="deskripsi"
                                                                    name="deskripsi" placeholder="deskripsi"
                                                                    value="{{ $kamar->deskripsi }}">
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
                                                                <input type="text" class="form-control" id="harga"
                                                                    name="harga" placeholder="harga"
                                                                    value="{{ $kamar->harga }}">
                                                                <div class="form-control-icon">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Desc Harga </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" id="deskripsi"
                                                                    name="deskripsi_harga" placeholder="deskripsi"
                                                                    value="{{ $kamar->deskripsi_harga }}">
                                                                <div class="form-control-icon">
                                                                    <i class="far fa-file-alt"></i>
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
                                                        <a type="button" class="btn bt-danger"
                                                            href="/penginapan/hotel/kamar/delete/{{ $kamar->id }}"
                                                            onclick="return confirm('Yakin ingin menghapus?')"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
    @endif

    <!--Basic Modal -->
    <div class="modal fade text-left" id="create" tabindex="-1" aria-labelledby="myModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Hotel</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal" action="{{ route('kamar.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <?php
                                $data = App\Models\Kamar::max('kode_kamar');
                                $huruf = 'K';
                                $urutan = (int) substr($data, 2, 3);
                                $urutan++;
                                $kode_kamar = $huruf . sprintf('%03s', $urutan);
                                ?>
                                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                <input type="hidden" name="tempat_id" value="{{ $tempat }}">
                                <div class="col-md-4">
                                    <label>Kode</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group ">
                                        <div class="position-relative"><input type="text" hidden name="kode_kamar"
                                                value="{{ $kode_kamar }}">
                                            {{ $kode_kamar }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Nama Kamar</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Nama Kamar" id="first-name-icon"
                                                value="{{ old('name') }}" required>

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
                                            <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
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
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                name="image" type="file" id="image" multiple="" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Kapasitas</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="number" class="form-control" name="kapasitas"
                                                placeholder="Kapasitas" value="{{ old('kapasistas') }}">
                                            <div class="form-control-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Type</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="type">
                                                    <option selected value='standard'>Standar</option>
                                                    <option selected value='vip'>VIP</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Harga *</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input name="harga" class="form-control" type="number" id="rupiah"
                                                placeholder="Harga" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Desc Harga</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <textarea class="form-control" name="deskripsi_harga" rows="3" required></textarea>
                                            <div class="form-control-icon">
                                                <i class="far fa-file-alt"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary me-1 mb-1">Tambah</button>
                            <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
