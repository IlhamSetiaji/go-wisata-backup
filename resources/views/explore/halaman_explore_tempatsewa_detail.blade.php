@extends('FrontEnd.main')
@section('content')
    <main class="main">
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-01.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">


        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="{{ asset('images') }}/{{ $tempatsewa->foto }}" alt="" class="home__img">
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Tempat</span>
                    <h1 class="home__data-title">{{ $tempatsewa->nama }}<br> <b>{{ $tempat->alamat }}</b></h1>
                    <a href="/pesan/tempatsewa/{{ $tempatsewa->id }}" class="button">PESAN TEMPAT</a>
                </div>
            </div>
        </section>
        </br>
        <div class="container">
            {!! Toastr::message() !!}
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">
                                            <a>{{ $tempatsewa->nama }}</a>
                                        </h5>
                                        <small>Rating : {{ round($avg, 1) }}/5</small>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item" align="justify"> {{ $tempatsewa->deskripsi }}</li>
                                        <li class="list-group-item">Lokasi : {{ $tempatsewa->lokasi }}</li>
                                        <li class="list-group-item">Telp : {{ $tempatsewa->telp }}</li>
                                        </li>
                                    </ul>
                                    </br>
                                    @php
                                        if (auth() != null) {
                                            $h = auth()->user();
                                        }
                                    @endphp
                                    @foreach ($review as $r)
                                        <div class="d-flex flex-start">
                                            <figure class="figure">
                                                @if ($r->user->image != null)
                                                    <img class="rounded-circle shadow-1-strong me-1"
                                                        src="{{ asset('images') }}/{{ $r->user->image }}" alt="avatar"
                                                        width="40" height="40" />
                                                @else
                                                    <img class="rounded-circle shadow-1-strong me-1"
                                                        src="{{ asset('images') }}/user_komen.jpg" alt="avatar"
                                                        width="40" height="40" />
                                                @endif
                                            </figure>
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="text-primary mb-0">
                                                        <span class="text-dark ms-2">{{ $r->nama }}</span>
                                                        <span class="badge rounded-pill bg-light"
                                                            style="font-size:10px;color:grey">
                                                            <i class="fa fa-calendar"
                                                                style="font-size:10px; color:#007bff;"></i>
                                                            {{ $r->created_at }}
                                                            @if ($h != null)
                                                                @if ($r->user->name == $h['name'])
                                                                    <a
                                                                        href="komentartempatsewa/delete/{{ $r->id }}"><i
                                                                            class="fas fa-trash primary"
                                                                            style="color:#007bff;"
                                                                            onclick="return confirm('Apakah anda yakin ingin hapus ?')"></i></a>
                                                                    <a data-bs-toggle="modal" style="color:#007bff;"
                                                                        data-bs-target="#update{{ $r->id }}">
                                                                        <i class="fas fa-pen"></i></a>
                                                                    <div class="modal fade text-left"
                                                                        id="update{{ $r->id }}" tabindex="-1"
                                                                        aria-labelledby="myModalLabel1"
                                                                        style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-scrollable"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel1">Edit Ulasan</h5>
                                                                                </div>
                                                                                <form
                                                                                    action="/komentartempatsewa/update/{{ $r->id }}"
                                                                                    method="POST" id="commentform"
                                                                                    class="comment-form">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div
                                                                                            class="comment-form-rating col-md-4">
                                                                                            <span class="stars">
                                                                                                <?php
                                                                                                for ($i = 1; $i <= 5; $i++) {
                                                                                                    echo "<label for='rated-$i' ></label>";
                                                                                                    echo "<input type='radio' id='rated-$i' name='rating' value='$i'";
                                                                                                    echo $r['rating'] == $i ? 'checked' : '';
                                                                                                    echo '></input>';
                                                                                                }
                                                                                                ?>
                                                                                            </span>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            </br>
                                                                                            <textarea id="comment" name="comment" cols="70" rows="8" placeholder="Type Review Here">{{ $r->comment }}</textarea>
                                                                                            </br>

                                                                                            <label>Comment as
                                                                                                &nbsp;&nbsp;&nbsp;
                                                                                                <input type="radio"
                                                                                                    name="nama"
                                                                                                    value="Anonymous"
                                                                                                    checked
                                                                                                    @php
                                                                                                        echo $r['nama'] == 'Anonymous' ? 'checked' : '';
                                                                                                    @endphp />Anonymous
                                                                                                &nbsp;&nbsp;&nbsp; <input
                                                                                                    type="radio"
                                                                                                    name="nama"
                                                                                                    value="{{ Auth::user()->name }}"
                                                                                                    @php
                                                                                                        echo $r['nama'] == Auth::user()->name ? 'checked' : '';
                                                                                                    @endphp />{{ Auth::user()->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary"
                                                                                            name="submit"
                                                                                            id="submit">Update</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </span>
                                                        <span class="comment-form-rating">
                                                            <span class="stars">
                                                                @for ($i = 1; $i <= $r->rating; $i++)
                                                                    <label for="rated-{{ $i }}"></label>
                                                                @endfor
                                                            </span>
                                                        </span>
                                                        <br />
                                                        <p align="justify" class="text-dark ms-2">{{ $r->comment }}</p>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="col-12 col-lg-3">
                    <?php
                    $allevent = App\Models\Event::orderby('created_at', 'DESC')
                        ->where('status', 1)
                        ->take(5)
                        ->get();
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Event terbaru</h4>
                        </div>
                        <div class="card-content pb-4">
                            @foreach ($allevent as $key => $value)
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="name ms-4">
                                        <h6 class="text-muted mb-0"><a target="_blank"
                                                href="/detail/explore-event/{{ $value->id }}">{{ $value->nama }}</a>
                                        </h6>
                                        @if ($value->harga <= 0)
                                            <h7 class="mb-1">Gratis</h7>
                                        @else
                                            <h7 class="mb-1">Rp.{{ number_format($value->harga) }}</h7>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
