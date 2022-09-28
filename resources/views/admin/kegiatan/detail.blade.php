@extends('admin.layouts2.master')
@section('title', 'Detail Kegiatan')



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
                <img src="{{ asset('images') }}/{{ $kegiatan->image }}" class="card-img-top img-fluid"
                    alt="singleminded">
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Info Kegiatan</h4>
                    </div>
                    <div class="card-content">
                            @if ($kegiatan->status == 0)
                            <a href="{{ route('update.status.kegiatan', [$kegiatan->id]) }}"><button
                                    class="btn btn-danger mr-5"> Inactive</button></a>
                            @else
                            <a href="{{ route('update.status.kegiatan', [$kegiatan->id]) }}"><button
                                    class="btn btn-warning mr-5"> Active</button></a>
                            @endif
                        

                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" enctype="multipart/form-data">

                                <div class="form-body">
                                    <div class="row">


                                        <div class="col-mt-8">
                                            {{-- <img alt="image"class="card-img-top img-fluid" width="50" src="{{asset('images')}}/{{$kegiatan->image}}">
                                            --}}
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    {{ $kegiatan->name }}
                                                </div>
                                            </div>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }} </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Deskripsi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    {{ $kegiatan->deskripsi }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Harga</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    Rp. {{ number_format($kegiatan->harga) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    <?php
                                                        $tgl_a = date('d F Y', strtotime($kegiatan->date_a));
                                                        $tgl_b = date('d F Y', strtotime($kegiatan->date_b));
                                                        ?>
                                                    {{ $tgl_a }} - {{ $tgl_b }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Waktu</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    {{ $kegiatan->jambuka }} - {{ $kegiatan->jamtutup }} WIB

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tempat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    {{ $tempat->name }}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Admin</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    {{ $user->name }}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tersedia</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group ">
                                                <div class="position-relative">
                                                    @if ($kegiatan->kapasitas_b >= $kegiatan->kapasitas)
                                                    Full
                                                    @else
                                                    <?php
                                                            $sisa = (int) $kegiatan->kapasitas - (int) $kegiatan->kapasitas_b;
                                                            ?>
                                                    Ya,
                                                    {{ $kegiatan->kapasitas_b }}/{{ $kegiatan->kapasitas }}
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="breadcrumb breadcrumb-right">
                            <a href="{{ route('kegiatan.index') }}"> <button
                                    class="btn btn-outline-secondary me-1 mb-1">Back</button></a>
                            <a data-bs-toggle="modal" data-bs-target="#peserta"> <button
                                    class="btn btn-outline-secondary me-1 mb-1">Peserta</button></a>
                            <a data-bs-toggle="modal" data-bs-target="#default"> <button
                                    class="btn btn-outline-primary me-1 mb-1">Update </button></a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- user profile modal --}}
    <div class="card-body">
        <!--Basic Modal -->
        <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Update Kegiatan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" action="{{ route('kegiatan.update', [$kegiatan->id]) }}"
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
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $kegiatan->name }}">
                                                <div class="form-control-icon">
                                                    {{-- <i class="bi bi-person"></i> --}}
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
                                                <input type="text" class="form-control" name="deskripsi"
                                                    value="{{ $kegiatan->deskripsi }}">
                                                <div class="form-control-icon">
                                                    {{-- <i class="bi bi-envelope"></i> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Photo</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-lefts">
                                            <div class="position-relative">
                                                <div class="form-control-icon avatar avatar.avatar-im">
                                                    <img src="{{ asset('images') }}/{{ $kegiatan->image }}">
                                                </div>
                                                <input type="file"
                                                    class="form-control file-upload-info @error('image') is-invalid @enderror" " placeholder="
                                                    Upload Image" name="image">
                                                <span class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Harga</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input name="harga" class="form-control" type="text" id="rupiah"
                                                    placeholder="Harga" value="{{ $kegiatan->harga }}">
                                                <div class="form-control-icon">

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label>Mulai</label>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="time" id="jb" name="jambuka"
                                                    class="form-control @error('jambuka') is-invalid @enderror"
                                                    value="{{ $kegiatan->jambuka }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Selesai</label>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="time" id="jt" name="jamtutup"
                                                    class="form-control @error('jamtutup') is-invalid @enderror"
                                                    value="{{ $kegiatan->jamtutup }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Kapasitas</label>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="number" class="form-control" name="kapasitas"
                                                    value="{{ $kegiatan->kapasitas }}">
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-12 d-flex justify-content-end">

                                        {{-- <a data-bs-toggle="modal" data-bs-target="#password"> <button class="btn btn-outline-secondary me-1 mb-1">Ganti Password </button></a> --}}
                                        <button type="submit" class="btn btn-outline-primary me-1 mb-1">Update</button>
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
        <!--Basic Modal -->
        <div class="modal fade text-left" id="peserta" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Peserta Kegiatan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-body">
                            <div class="row">
                                <?php
                                    $dt = App\Models\Detail_transaksi::where('id_produk', $kegiatan->kode_kegiatan)->get();
                                    ?>
                                @foreach ($dt as $key => $value)
                                <div class="col-md-4">
                                    <label>Peserta {{ $key }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <?php
                                                    $user = App\Models\User::where('id', $value->user_id)->first();
                                                    ?>
                                            {{ $user->name }}
                                            <div class="form-control-icon">
                                                {{-- <i class="bi bi-person"></i> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>

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


    </div>
    <!-- Hoverable rows end -->

</div>

<!-- list group button & badge ends -->
<script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function (e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>
<script type="text/javascript">
    $(function () {

        var start = moment().subtract(29, 'days');
        var end = moment();


        function cb(start, end) {
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#daterange').daterangepicker({
            format: 'YYYY-MM-DD',
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],

                'This Month': [moment().startOf('month'), moment().endOf('month')],

            }
        }, cb);

        cb(start, end);
        $('#daterange').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD'));
        });

    });

</script>
@endsection
