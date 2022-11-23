@extends('admin.layouts2.master')
@section('title', 'Detail Create Paket')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
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
                    <h3>Detail Paket</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('budget.index') }}">Paket</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ dd($dataDesa) }} --}}
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Paket</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {{-- {{ dd($paket["data_kategori"][0]->nama_kategori) }} --}}
                                <ul>
                                    <li>Nama Paket : {{ $paket['nama_paket'] }}</li>
                                    <li>Kategori Paket :
                                        <br>
                                        @for ($i = 0; $i < count($paket['data_kategori']); $i++)
                                            {{ $paket['data_kategori'][$i]->nama_kategori }} <br>
                                        @endfor
                                    </li>
                                    <li>Jumlah Hari : {{ $paket['jml_hari'] }}</li>
                                    <li>Jumlah Orang : {{ $paket['jml_orang'] }}</li>
                                </ul>

                                <form action="{{ route('budget.detail.create') }}" id="form" method="GET"
                                    enctype="multipart/form-data" class="form">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="admin">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Isi Paket</th>
                                                    <th scope="col">Aksi</th>
                                                    <th scope="col">Harga Satuan</th>
                                                    <th scope="col">Harga Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $nomor = count($wisatas) + count($wahanas) + count($hotels) + count($villas); ?>
                                                {{-- {{ dd($nomor) }} --}}
                                                <?php $i = 1; ?>
                                                @foreach ($wisatas as $wisata)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $wisata->name }}</td>
                                                        <td> - </td>
                                                        <td> {{ $wisata->dana != null ? 'Rp' . $wisata->dana : 'Rp0' }}
                                                        </td>
                                                        <td> {{ $wisata->dana != null ? 'Rp' . $wisata->dana : 'Rp0' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($wahanas as $wahana)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $wahana->name }}</td>
                                                        <td> - </td>
                                                        <td> {{ $wahana->harga != null ? 'Rp' . $wahana->harga : 'Rp0' }}
                                                        </td>
                                                        <td> {{ $wahana->harga != null ? 'Rp' . $wahana->harga : 'Rp0' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($villas as $villa)
                                                    <tr>
                                                        <td> {{ $i++ }} </td>
                                                        <td>{{ $villa->nama }}</td>
                                                        <td> - </td>
                                                        <td> {{ $villa->harga != null ? 'Rp' . $villa->harga : 'Rp0' }}
                                                        </td>
                                                        <td> {{ $villa->harga != null ? 'Rp' . $villa->harga : 'Rp0' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{-- {{ dd($kamars) }} --}}
                                                @foreach ($hotels as $hotel)
                                                    <tr>
                                                        <td> {{ $i++ }} </td>
                                                        <td>{{ $hotel->nama }}</td>
                                                        <td>
                                                            <select class="form-select" name="data_penginapanvilla[]"
                                                                id='data-penginapan-villa'>
                                                                <option value="">Pilih Kamar
                                                                </option>
                                                                @foreach ($kamars as $datas)
                                                                    @foreach ($datas as $kamar)
                                                                        @if ($kamar->hotel_id == $hotel->id)
                                                                            <option value="{{ $kamar->id }}">
                                                                                {{ $kamar->name }} - {{ $kamar->harga }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td> - </td>
                                                        <td> - </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $kuliners->nama_paket }}</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2">
                                                    <td class="d-flex justify-content-end">
                                                        <b>Total:</b>
                                                    </td>
                                    </div>
                                    <td></td>
                                    <td>Rp20000</td>
                                    </tr>
                                    </tbody>
                                    </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" class="form-control" placeholder="Harga">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mt-2">Submit</button>
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
    <script></script>
@endsection
