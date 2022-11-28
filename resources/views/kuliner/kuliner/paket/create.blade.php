@extends('admin.layouts2.master')
@section('title', 'Admin - Kuliner')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>

    <div class="page-content">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Paket kuliner</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form action="{{ route('paket.store') }} " method="POST" enctype="multipart/form-data"
                                    class="form form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Paket Kuliner</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="nama_paket" placeholder="Nama Paket"
                                                            id="first-name-icon" value="{{ old('name') }}" required>

                                                        <div class="form-control-icon">
                                                            <i class="fas fa-utensils"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Makanan</label>
                                            </div>
                                            <div class="col-md-8" id="makan">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="makan[]" id="data-makan"
                                                                required>
                                                                <option value="">Pilih Makanan</option>
                                                                @foreach ($makans as $makan)
                                                                    <option value="{{ $makan->id }}">{{ $makan->name }}
                                                                        - {{ $makan->harga }}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Minum</label>
                                            </div>
                                            <div class="col-md-8" id="minum">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="minum[]" id="data-minum" required>
                                                                <option value="">Pilih Minum</option>
                                                                @foreach ($minums as $minum)
                                                                    <option value="{{ $minum->id }}">{{ $minum->name }}
                                                                        - {{ $minum->harga }}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Snack</label>
                                            </div>
                                            <div class="col-md-8" id="snack">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="snack[]" id="data-snack">
                                                                <option value="">Pilih Snack</option>
                                                                @foreach ($snacks as $snack)
                                                                    <option value="{{ $snack->id }}">{{ $snack->name }}
                                                                        - {{ $snack->harga }}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" id="first-name-icon" value="{{ old('name') }}"
                                                            required readonly>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    <script>
        $(document).ready(function() {
            $(document).on('change', '#data-makan', function() {
                var allGood = true;

                if ($(this).val() == "") {
                    console.log('false');
                    return allGood = false;
                }

                if (allGood) {
                    $('#makan').append($('<div class="form-group"><div class="position-relative"><fieldset class="form-group"><select class="form-select" name="makan[]" id="data-makan"><option value="">Pilih Makanan</option>@foreach ($makans as $makan)<option value="{{ $makan->id }}">{{ $makan->name }}- {{ $makan->harga }}</option>@endforeach</select></fieldset></div></div>'));
                }
            });
        });
        $(document).ready(function() {
            $(document).on('change', '#data-minum', function() {
                var allGood = true;

                if ($(this).val() == "") {
                    console.log('false');
                    return allGood = false;
                }

                if (allGood) {
                    $('#minum').append($('<div class="form-group"><div class="position-relative"><fieldset class="form-group"><select class="form-select" name="minum[]" id="data-minum"><option value="">Pilih Minum</option>@foreach ($minums as $minum)<option value="{{ $minum->id }}">{{ $minum->name }}- {{ $minum->harga }}</option>@endforeach</select></fieldset></div></div>'));
                }
            });
        });
        $(document).ready(function() {
            $(document).on('change', '#data-snack', function() {
                var allGood = true;

                if ($(this).val() == "") {
                    console.log('false');
                    return allGood = false;
                }

                if (allGood) {
                    $('#snack').append($('<div class="form-group"><div class="position-relative"><fieldset class="form-group"><select class="form-select" name="snack[]" id="data-snack"><option value="">Pilih Snack</option>@foreach ($snacks as $snack)<option value="{{ $snack->id }}">{{ $snack->name }}- {{ $snack->harga }}</option>@endforeach</select></fieldset></div></div>'));
                }
            });
        });
    </script>
@endsection
