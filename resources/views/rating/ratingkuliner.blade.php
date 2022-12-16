<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    <body>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div id="review_form_wrapper">
                        <div id="review_form">
                            <h5 class="modal-title">Ulasan Anda</h5>
                            <div id="respond" class="comment-respond">
                                <form action="{{ route('create_ratingkuliner', [$kode]) }}" method="POST" id="commentform" class="comment-form">                                    @method('PUT')
                                    @csrf
                                    <div class="comment-form-rating">
                                        <p class="stars">
                                            <label for="rated-1"></label>
                                            <input type="radio" id="rated-1" name="rating" value="1"
                                                {{ $reviewkuliner->rating == 1
                                                    ? '
                                                                                                                                                                                                checked="checked"'
                                                    : '' }}>
                                            <label for="rated-2"></label>
                                            <input type="radio" id="rated-2" name="rating" value="2"
                                                {{ $reviewkuliner->rating == 2
                                                    ? '
                                                                                                                                                                                                checked="checked"'
                                                    : '' }}>
                                            <label for="rated-3"></label>
                                            <input type="radio" id="rated-3" name="rating" value="3"
                                                {{ $reviewkuliner->rating == 3
                                                    ? '
                                                                                                                                                                                                checked="checked"'
                                                    : '' }}>
                                            <label for="rated-4"></label>
                                            <input type="radio" id="rated-4" name="rating" value="4"
                                                {{ $reviewkuliner->rating == 4
                                                    ? '
                                                                                                                                                                                                checked="checked"'
                                                    : '' }}>
                                            <label for="rated-5"></label>
                                            <input type="radio" id="rated-5" name="rating" value="5"
                                                {{ $reviewkuliner->rating == 5
                                                    ? '
                                                                                                                                                                                                checked="checked"'
                                                    : '' }}>
                                        </p>
                                    </div>
                                    <p class="comment-form-comment">
                                        <textarea id="comment" name="comment" cols="45" rows="8" placeholder="Type Review Here">{{ $reviewkuliner->comment }}</textarea>
                                    </p>
                                    <p class="form-submit d-flex justify-content-between">
                                        <a href="{{ url('pesananku') }}" class="btn btn-dark ">Kembali</a>
                                        {{-- <input name="submit" type="submit" id="submit" class="submit" value="Submit"> --}}
                                        <button type="submit" class="btn btn-primary" name="submit"
                                            id="submit">Perbarui</button>
                                    </p>
                                </form>
                            </div><!-- .comment-respond-->
                        </div><!-- #review_form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <form class="py-2 px-4" action="/rating" style="box-shadow: 0 0 10px 0 #ddd;"
                    method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <p class="font-weight-bold ">Review</p>
                    <div class="form-group row">
                        <input type="hidden" name="kuliner_id" value="{{ $value->id }}">
                        <div class="col">
                            <div class="rate">
                                <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col">
                            <textarea class="form-control" name="comment" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 text-right">
                        <button class="btn btn-sm py-2 px-3 btn-info">Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
