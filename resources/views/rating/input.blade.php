@extends('pesanan.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-01.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">

    <body>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div id="review_form_wrapper">
                        <div id="review_form">
                            <h5 class="modal-title">Ulasan</h5>
                            <div id="respond" class="comment-respond">

                                <form action="" method="POST" id="commentform"
                                    class="comment-form">
                                    @csrf
                                    <div class="comment-form-rating ">
                                        <p class="stars"> 
                                            <label for="rated-1"></label>
                                            <input type="radio" id="rated-1" name="rating" value="1">
                                            <label for="rated-2"></label>
                                            <input type="radio" id="rated-2" name="rating" value="2">
                                            <label for="rated-3"></label>
                                            <input type="radio" id="rated-3" name="rating" value="3">
                                            <label for="rated-4"></label>
                                            <input type="radio" id="rated-4" name="rating" value="4">
                                            <label for="rated-5"></label>
                                            <input type="radio" id="rated-5" name="rating" value="5"
                                                checked="checked">
                                        </p>
                                    </div>
                                    <p class="comment-form-comment mt-2">
                                        <textarea id="comment" name="comment" cols="45" rows="8" placeholder="Type Review Here"></textarea>
                                    </p>
                                    <p class="form-submit">
                                        {{-- <input name="submit" type="submit" id="submit" class="submit" value="Submit"> --}}
                                        <button type="submit" class="btn btn-primary" name="submit"
                                            id="submit">Submit</button>
                                    </p>
                                </form>
                            </div><!-- .comment-respond-->
                        </div><!-- #review_form -->
                    </div>
                </div>
            </div>
        </div>
    </body>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
@endsection
