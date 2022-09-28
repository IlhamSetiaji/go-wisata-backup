@extends('pesanan.master')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>


<div id="main-content">
<div class="container">

    {!! Toastr::message() !!}
    @foreach ($errors->all() as $error)
    {!!  Toastr::error($error, 'Error', ['options']) !!}
    {{-- <p class="text-danger">{{ $error }}</p> --}}
    @endforeach
<div class="row">
<div class="col-xl-4 col-md-6 col-sm-12">
    <div class="card" data-bs-toggle="modal" data-bs-target="#default2">
        <div class="card-content">
            <img src="{{asset('images')}}/topup.png" class="card-img-top img-fluid"
            alt="singleminded">
            {{-- @if(Auth::user()->image == null) --}}
             {{-- <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/user.jpg"> --}}
              {{-- @else
              <img src="{{asset('images')}}/{{Auth::user()->image}}" class="card-img-top img-fluid"
                alt="singleminded">
              @endif --}}

            {{-- <div class="card-body">
                <h5 class="card-title">{{ Auth::user()->name }}</h5>

            </div> --}}
        </div>
        {{-- Dibuat tanggal : {{ substr(App\Models\User::pluck('created_at')->first(),0,10) }} </li> --}}


    </div>


</div>
<div class="col-md-5">
    <div class="card-content">

        <div class="card"  data-bs-toggle="modal" data-bs-target="#default" >
            <div class="card-header">
                <h4 class="card-title"><center>Silahkan Mengisi Nominal</center></h4>
                {{-- Akun dibuat tanggal :  {{ substr(App\Models\User::pluck('created_at')->first(),0,10) }} --}}
            </div>

                <div class="card-body">
                    <div class="form-body">
                        <form action="{{ route('store.topup') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" name="nominal" id="rupiah" class="form-control" placeholder="Jumlah" style="text-align:center" required>
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>          
                            <center><button type="submit" class="btn btn-primary mt-2">Top Up</button></center>
                          </form>
                </div>
        </div>
    </div>



</div>


</div>
  <div class="col-6 col-lg-3 col-md-6">
         {{-- <a href="{{ url('/topup') }}"><button
                class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Isi Saldo 
            </button></a> --}}
                    <a href="{{ url('/pesananku') }}">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold"><b>Saldo</b></h6>
                                        <h6 class="font-extrabold mb-0">
                                            
                                            @if (Auth::user()->balance == NULL )
                                            0
                                            @else
                                            {{-- Rp.{{ number_format($whn->harga) }} --}}
                                            Rp. {{ number_format(Auth::user()->balance) }}
                                            @endif
                                            {{-- {{App\Models\User::where('user_id', Auth::user()->id)->pluck('balance')->first()}} --}}
                                        </h6>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </a>


                </div>

</div>

  <!--Rupiah JS -->

  <script type="text/javascript">

    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
 
@endsection
