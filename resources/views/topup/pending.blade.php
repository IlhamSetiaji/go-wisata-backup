
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      /* i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      } */
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      {!! Toastr::message() !!} 
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="fa fa-hourglass" style="font-size:140pt;color:rgb(55, 156, 55)"></i>
      </div>
      <b><p id="demo"></p></b>
        <h1>Menunggu</h1> 
        <p>{{ $topup->keterangan }}</p>
        <p class="mt-1">Silahkan Transfer ke No Rekening Dibawah Ini dengan Jumlah : </p>
        <h2><b>Rp. {{ number_format($topup->nominal_ditransfer) }}</b></h2>
        <h2>No Rekening : <b>1427123512 (BNI)</b></h2>
        <h3><b>Atas Nama Ridwan Nur Hidayat</b></h3>
        <form action="{{url('pending/'.$topup->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="Terbayar">
        <input type="hidden" name="keterangan" value="Sudah Terbayar, Saldo Sudah Ditambahkan">
        <center><button  type="submit" id="button" class="btn btn-primary mt-4">Halaman Utama</button></center>
        </form>
        {{-- <a href="{{ url('/') }}"><button class="btn btn-primary mt-4"> Halaman Utama </button></a></center> --}}
      </div>
    </body>

    <script>
      
    </script>

    <script>
      
//       function startTimer() {
//     var timer = minutes, seconds;
//     var btn = document.getElementById("button");
//     var spn = document.getElementById("demo");
//     setInterval(function () {
//         minutes = parseInt(timer / 60, 10);
//         seconds = parseInt(timer % 60, 10);

//         minutes = minutes < 10 ? "0" + minutes : minutes;
//         seconds = seconds < 10 ? "0" + seconds : seconds;

//         spn.textContent = minutes + ":" + seconds;

//         if (--timer < 0) {
//             timer--;
//         }
//         else {
//      // Enable the button
//        btn.removeAttribute("disabled");
//         }
//       }, 1000);

// }

  //     var minute = 2;
  //     var sec = 60;
  //     setInterval(function() {
  //     document.getElementById("demo").innerHTML = minute + " : " + sec;
  //     sec--;
  //     if (sec == 00) {
  //     minute --;
  //     sec = 60;
  //     if (minute == 0) {
  //       minute = 2;
  //     }
  //   }
  // }, 1000);

      var spn = document.getElementById("demo");
      var btn = document.getElementById("button");

    var count = 80;     // Set count
    var minute = 2;
      var timer = null;  // For referencing the timer

(function countDown(){
  // Display counter and start counting down
  spn.textContent = count;
  
  // Run the function again every second if the count is not zero
  // count--;
  // if(count == 00){
  //   minute--;
  //   count = 60;
  //   if(minute !== 0){
  //     timer = setTimeout(countDown, 1000);
  //   }
  // }

  if(count !== 0){
    timer = setTimeout(countDown, 1000);
    count--; // decrease the timer
  }
   else {
    // Enable the button
    btn.removeAttribute("disabled");
  }
}());

      </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('assets/js/main.js') }}"></script>
</html>