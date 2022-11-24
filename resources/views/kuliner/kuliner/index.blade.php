@extends('admin.layouts2.master')
@section('title', 'Kuliner')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}



    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Kuliner</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data tentang Kuliner</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href=" {{ route('paket.create') }}" class="btn btn-outline-warning mr-2">
                <i class="fas fa-plus"></i>Tambah Paket Makanan </a>
            <a href="{{ route('kuliner.create') }}" class="btn btn-outline-primary "> <i class="fas fa-plus"></i>Tambah
                Makanan
            </a>
        </div>
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-right">
                <li class="breadcrumb-item"> 
                    </li>
                <li class="breadcrumb-item"> 
                        </li>
            </ol>
        </nav> --}}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#menu"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Menu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#paket"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Paket</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="home-tab">
                            @if (count($kuliner) > 0)
                                @foreach ($kuliner as $key => $kuliner)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card" style="background-color: #F2F7FF">
                                                <div class="card-content">
                                                    <img class="img-fluid w-100"
                                                        src="{{ asset('images') }}/{{ $kuliner->image }}"
                                                        alt="Card image cap" style="height: 25rem">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ $kuliner->name }}</h4>
                                                        {{ $kuliner->deskripsi }}

                                                        <small class="breadcrumb breadcrumb-right">
                                                            @if ($kuliner->harga == 0)
                                                                Free
                                                            @else
                                                                <a class="btn disabled  btn-outline-primary"
                                                                    href="#">harga: Rp.
                                                                    {{ $kuliner->harga }}</a>
                                                            @endif
                                                        </small>
                                                        <p class="card-text">

                                                        </p>
                                                        {{-- <button class="btn btn-primary block">Update now</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="background-color: #F2F7FF">
                                            <div class="card-content">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Detail </h4>
                                                        <nav aria-label="breadcrumb"
                                                            class="breadcrumb-header float-start float-lg-end">
                                                            <ol class="breadcrumb">
                                                                @if ($kuliner->status == 1)
                                                                    <a
                                                                        href="{{ route('update.status.kuliner', [$kuliner->id]) }}"><button
                                                                            class="btn btn-warning"> Active</button></a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('update.status.kuliner', [$kuliner->id]) }}"><button
                                                                            class="btn btn-danger"> Inactive</button></a>
                                                                @endif
                                                            </ol>
                                                        </nav>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form form-horizontal"
                                                            action="{{ route('kuliner.update', [$kuliner->id]) }} "
                                                            method="POST" enctype="multipart/form-data">
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
                                                                                <input type="name" class="form-control"
                                                                                    name="name" placeholder="Name"
                                                                                    id="name"
                                                                                    value="{{ $kuliner->name }}" required>
                                                                                <div class="form-control-icon">
                                                                                    <i class="fas fa-utensils"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @error('name')
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
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
                                                                                    placeholder="Upload Image"
                                                                                    name="image">
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
                                                                                <input class="form-control" id="deskripsi"
                                                                                    name="deskripsi"
                                                                                    placeholder="{{ $kuliner->deskripsi }}"
                                                                                    value="{{ $kuliner->deskripsi }}"></input>
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
                                                                                <input type="text" class="form-control"
                                                                                    id="harga" name="harga"
                                                                                    placeholder="harga"
                                                                                    value="{{ $kuliner->harga }}">
                                                                                <div class="form-control-icon">
                                                                                    <i class="fas fa-dollar-sign"></i>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <form class="forms-sample col-12 d-flex justify-content-end"
                                                            action="{{ route('kuliner.destroy', [$kuliner->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn bt-danger"
                                                                onclick="return confirm('Are you sure to want to delete it?')"><i
                                                                    class="bi bi-trash"></i></span> </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        Tidak ada kuliner di tempat ini, silahkan menambahkan
                                        kuliner :)
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- {{ dd($paketKuliner[0]->status) }} --}}
                        <div class="tab-pane fade" id="paket" role="tabpanel" aria-labelledby="profile-tab">
                            {{-- <div class="container"> --}}
                            <div class="row">
                                {{-- {{ dd($paketKuliner) }} --}}
                                @foreach ($paketKuliner as $item)
                                    <div class="col-md-6">
                                        <div class="card mt-2" style="background-color: #F2F7FF">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h2 class="card-title">{{ $item->nama_paket }}</h2>
                                                    <h4>Harga {{ number_format($item->harga) }}</h4>
                                                    @if ($item->status == 1)
                                                        <p>Aktif</p>
                                                    @else
                                                        <p>Tidak Aktif</p>
                                                    @endif
                                                    <ul>
                                                        {{-- {{ dd($dataPaketKuliner) }} --}}
                                                        @foreach ($dataPaketKuliner as $datas)
                                                            @foreach ($datas as $data)
                                                                @if ($data->data_paket_kuliner_id == $item->id)
                                                                    <li>{{ $data->kuliner->name }}</li>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                    <div class="row">
                                                        <div class="col">
                                                            <form action="{{ route('update.status.paket.kuliner') }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @if ($item->status == 1)
                                                                    <input type="text" name="id"
                                                                        value="{{ $item->id }}" hidden>
                                                                    <input type="text" name="status" id="status"
                                                                        value="0" hidden>
                                                                    <button
                                                                        class="btn btn-outline-danger mr-2">Nonaktifkan</button>
                                                                @else
                                                                    <input type="text" name="id"
                                                                        value="{{ $item->id }}" hidden>
                                                                    <input type="text" name="status" id="status"
                                                                        value="1" hidden>
                                                                    <button
                                                                        class="btn btn-outline-info mr-2">Aktifkan</button>
                                                                @endif
                                                            </form>
                                                            <a href="/akuliner/paket/{{ $item->id }}/edit"
                                                                class="btn btn-outline-warning">Edit</a>

                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>

                                                    <small class="breadcrumb breadcrumb-right">
                                                        {{-- @if ($kuliner->harga == 0)
                                                            Free
                                                        @else
                                                        <a class="btn disabled  btn-outline-primary"
                                                        href="#">harga: Rp.
                                                        {{ $kuliner->harga }}</a>
                                                        @endif --}}
                                                    </small>
                                                    <p class="card-text">

                                                    </p>
                                                    {{-- <button class="btn btn-primary block">Update now</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
