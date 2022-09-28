<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoWisata.</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/GoWisata.png') }}">
    <script src="https://kit.fontawesome.com/ad6395cc9e.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<header class='mb-3'>

</header>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-hH-4E7hWQH8DQJGF"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            {{-- <a href="index.html"><i class="bi bi-chevron-left"></i></a> --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-map-marker"></i>
                GoWisata.
            </a>
        </div>
    </nav>
    <nav class="navbar navbar-light">
        <div class="container d-block">


            <button onclick="goBack()"><i class="bi bi-chevron-left"></i></button>

        </div>
    </nav>

    @if ($tiket != null)
        <div id="main-content">
            <div class="row">
                <div clas="card">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title  ">
                                    <ul class="pagination pagination-primary  justify-content-center">
                                        Chekout
                                    </ul>
                                </h4>
                            </div>
                            <div class="card-body">
                                <ul class="pagination pagination-primary  justify-content-center">
                                    Nama : {{ $tiket->name }}
                                    <br>

                                    {{-- Tempat : {{ $tiket->tempat->name }} --}}

                                    {{-- Jumlah : {{ $tiket->jml_orang }} orang --}}

                                    Harga : Rp. {{ number_format($tiket->harga) }}

                                </ul>
                                <ul class="pagination pagination-primary  justify-content-center">
                                    <button id="pay-button" type="button" class="btn btn-primary">pay! </button>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @else
    @endif
    <nav aria-label="Page navigation example">

    </nav>



    {{-- <form id="payment-form" method="get" action="Payment"> --}}
    {{-- <input type="hidden" nama="id"  value="$tiket->id"> --}}
    {{-- <input type="hidden" nama="result_data" id="result-data" value="">
            </form> --}}
    <form id="payment-form" method="post" action="snapfinish">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="result_type" id="result-type" value=""></div>
        <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form>



    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // Snaptoken acquired

            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type, data) {
                $("#result-type").val(type);
                $("#result-data").val(JSON.stringify(data));

            }
            snap.pay('<?= $snapToken ?>', {

                onSuccess: function(result) {
                    ochangeResult('success', result);
                    console.log(result.status_message);
                    console.log(result);
                    $("#payment-form").submit();

                },
                onPending: function(result) {
                    changeResult('pending', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();

                },
                onError: function(result) {
                    changeResult('error', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();

                }
            });
        }
    </script>



</body>
<script>
    function goBack() {
        window.history.back();
    }
</script>

<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('assets/js/main.js') }}"></script>


</html>
