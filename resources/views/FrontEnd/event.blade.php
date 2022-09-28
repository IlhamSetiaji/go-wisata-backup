@extends('pesanan.mastern')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}




     <div class="content-wrapper container">

        <div class="page-heading">
        <h3>Event </h3>
        </div>
        <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                @foreach($event as $key => $value)
                <?php

                $tgl_a = date('d F Y',  strtotime($value->date_a));
                $tgl_b = date('d F Y',  strtotime($value->date_b));
                $today = Carbon\carbon::today();
                if($today <=  Carbon\carbon::parse($value->date_b)){
                    $c = 1;
                }else {
                    $c = 0;
                }
                // dd($today,Carbon\carbon::parse($value->date_b),$c);


                // $cek2 = ($today >  Carbon\carbon::parse($value->date_b));
                // dd($today,Carbon\carbon::parse($value->date_b),$cek);
               ?>
                <div class="row">

                    <div class="col-12 col-xl-3">
                        <div >
                            <img class="img-fluid w-100" src="{{asset('images')}}/{{$value->image}}" alt="Card image cap">
                            {{-- <img src="{{asset('images')}}/{{$value->image}}" alt="Face 1" style="width:200px;height:200px;"> --}}
                        </div>
                    </div>
                    <div class="col-12 col-xl-9">
                        <div class="card" >
                            <div class="card-header">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $value->name }}
                                        @if($value->kapasitas_b >= $value->kapasitas) <button class="btn btn-primary" disabled>Full</button> @endif
                                        @if($c == 0) <button class="btn btn-info" disabled>Terlewat</button> @endif
                                    </h5>
                                    <small>{{ $value->kapasitas_b }}/{{ $value->kapasitas }}</small>
                                </div>
                                {{-- <h4>{{ $value->name }}</h4> --}}
                            </div>
                            <div class="card-body">
                                <p>
                                   {{$value->deskripsi}}
                                </p>
                                <ul class="list-group">
                                    <li class="list-group-item active"> </li>
                                    <li class="list-group-item">Harga : Rp. {{ number_format($value->harga) }}</li>
                                    <li class="list-group-item">

                                      Tanggal : {{ $tgl_a }} - {{ $tgl_b }}</li>
                                    <li class="list-group-item">Kapasitas : {{$value->kapasitas}} orang</li>
                                    <li class="list-group-item">Tempat :  {{ $value->tempat->name }}</li>

                                </ul>
                                <br>
                                @if($value->kapasitas_b < $value->kapasitas  && $c ==1 )
                                <form action="{{ route('ikut.event') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="card-footer d-flex justify-content-between">
                                    <span>Pesan ? &nbsp;&nbsp;&nbsp;</span>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="kodeevent" value="{{ $value->kode_kegiatan }}" >
                                        <input type="hidden" name="id" value="{{ $value->id }}" >
                                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Orang"
                                            aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-addon2"> <i class="fas fa-cart-plus"></i></button>

                                    </div>
                                </div>
                                </form>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>
                <br>
                  <!--Basic Modal -->
                  <div class="modal fade text-left" id="gambar" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                    role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Gambar Event {{ $value->name }}</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset('images')}}/{{$value->image}}" alt="Face 1" >
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
                @endforeach


            </div>

            <div class="col-12 col-lg-3">
                <?php
                    $allevent = App\Models\Kegiatan::with(['tempat'])->orderby('created_at','DESC')->where('status',1)->take(5)->get();
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Event terbaru</h4>
                    </div>
                    <div class="card-content pb-4">
                        @foreach($allevent as $key => $value)
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="{{asset('images')}}/{{$value->image}}">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">{{ $value->name }}</h5>


                                <h6 class="text-muted mb-0"><a href="{{ url('/event',[$value->tempat->slug]) }}">@ {{ $value->tempat->name }}</a></h6>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="px-4">
                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                                Conversation</button>
                        </div> --}}
                    </div>
                </div>

            </div>
        </section>
        {{ $event->links('vendor.pagination.custom') }}

        </div>
     </div>


@endsection
