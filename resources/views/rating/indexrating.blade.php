@extends('FrontEnd.main')
@section('content')
    <main class="main">
        <!--=============== CSS ===============-->
        <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('./vendor/depan/assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
        {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('/add-rating') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kuliner_id" value="{{ kuliner->id }}">
                        <div class="modal-center">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Rating {{ $whn->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="rating-css">
                                    <div class="star-icon">
                                        <input type="radio" value="1" name="kuliner_rating" checked id="rating1">
                                        <label for="rating1" class="fa fa-star"></label>
                                        <input type="radio" value="2" name="kuliner_rating" checked id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>
                                        <input type="radio" value="3" name="kuliner_rating" checked id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>
                                        <input type="radio" value="4" name="kuliner_rating" checked id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>
                                        <input type="radio" value="5" name="kuliner_rating" checked id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <img src="" alt="" class="w-100">
                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-0">{{ $whn->name }}</h2>

                            <hr>
                            <label for="" class="me-3">Price : Rp.{{ number_format($whn->harga) }}</label>
                            <p class="mt-3">{{ $kuliner->deskripsi }}</p>
                            <hr>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Rating</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@endsection
