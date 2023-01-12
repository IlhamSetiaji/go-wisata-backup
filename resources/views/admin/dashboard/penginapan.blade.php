@extends('admin.layouts2.master')
@section('title', 'Admin Penginapan Page')
{{-- @section('page', 'Dashboard ') --}}


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}
    @foreach ($errors->all() as $error)
        {!! Toastr::error($error, 'Error', ['options']) !!}
    @endforeach
    <header class='mb-3'>
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container-fluid">
                <div class="page-heading">
                    <h3>Statistics Data Penginapan </h3>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown me-1">
                        </li>
                        <li class="nav-item dropdown me-3">
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                    <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->role->name }}</p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        @if (Auth::user()->image == null)
                                            <img alt="image" class="mr-3 rounded-circle" width="50"
                                                src="{{ asset('images') }}/user.png">
                                        @else
                                            <div class="avatar avatar-xl">
                                                <img src="{{ asset('images') }}/{{ Auth::user()->image }}">

                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}!</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('atf.ppenginapan') }}"><i
                                        class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">

                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('danap.index') }}">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Dana</h6>
                                            <h6 class="font-extrabold mb-0">Rp. {{ number_format($tempatt->dana) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('booking.index') }}">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Pesanan</h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ App\Models\Detail_transaksi::where('tempat_id', $tempatt->id)->count() }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('hotel.index') }}">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="fas fa-bed"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Hotel</h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ App\Models\Hotel::where('tempat_id', $tempatt->id)->count() }} </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('villa.index') }}">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Villa</h6>

                                            <h6 class="font-extrabold mb-0">
                                                {{ App\Models\Villa::where('user_id', Auth::user()->id)->count() }} </h6>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('rekapw.index') }}">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon green">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Rekap Data</h6>
                                            <h6 class="font-extrabold mb-0"> Pesanan</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div> --}}
                    {{-- <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('kegiatan.index') }}">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="fas fa-child"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Kegiatan</h6>
                                            <h6 class="font-extrabold mb-0"> Event</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div> --}}





                </div>

            </div>
            <div class="col-12 col-lg-6">
                <div class="card" data-bs-toggle="modal" data-bs-target="#default">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                {{-- <img src="{{ URL::to('/images/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->avatar }}"> --}}
                                <img alt="Face 1" class="mr-3 rounded-circle" width="50"
                                    src="{{ asset('images') }}/{{ Auth::user()->image }}">
                                {{-- <img src="assets/images/faces/1.jpg" alt="Face 1"> --}}
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="font-extrabold mb-0"> Petugas</h6>
                                {{-- <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <a href="{{ route('atf.penginapan') }}">
                    <div class="card">
                        <div class="card-body py-4 px-5">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    {{-- <img src="{{ URL::to('/images/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->avatar }}"> --}}
                                    <img alt="Face 1" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset('images') }}/{{ $tempat->image }}">
                                    {{-- <img src="assets/images/faces/1.jpg" alt="Face 1"> --}}
                                </div>
                                <div class="ms-3 name">
                                    <h5> {{ $tempat->name }}</h5>


                                    {{ $tempattt->kategori }}, {{ $tempattt->name }}


                                    {{-- <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </section>
        <!--Basic Modal -->
        <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Update Profile</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" action="{{ route('profile.update', [Auth::user()->id]) }}"
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
                                                    value="{{ Auth::user()->name }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-envelope"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jenis Kelamin</label>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <fieldset class="form-group">

                                                    <select class="form-select" name="jk" required>
                                                        <option value=""
                                                            @if (Auth::user()->jk == null) selected @endif>Please select
                                                            jk</option>
                                                        <option value="pria"
                                                            @if (Auth::user()->jk == 'pria') selected @endif>Pria</option>
                                                        <option value="wanita"
                                                            @if (Auth::user()->jk == 'wanita') selected @endif>Wanita
                                                        </option>

                                                    </select>
                                                </fieldset>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Mobile</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="number" class="form-control" name="telp"
                                                    value="{{ Auth::user()->telp }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">

                                                @if (auth()->user()->status == 1)
                                                    <input type="text" class="form-control" value="Active" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="Inactive" readonly>
                                                @endif

                                                <div class="form-control-icon">
                                                    <i class="fas fa-user-cog"></i>
                                                    {{-- <i class="bi bi-bag-check"></i> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Alamat</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" name="alamat"
                                                    value="{{ Auth::user()->alamat }}">
                                                <div class="form-control-icon">

                                                    <i class="far fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">

                                        <a data-bs-toggle="modal" data-bs-target="#password"> <button
                                                class="btn btn-outline-secondary me-1 mb-1">Ganti Password </button></a>
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
        <div class="modal fade text-left" id="password" tabindex="-1" aria-labelledby="myModalLabel1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Update Password</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-horizontal" action="{{ route('profile.update3', [Auth::user()->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Password Lama</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="password" class="form-control" name="current_password">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password Baru</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="password" class="form-control" name="new_password">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Konfirmasi Password Baru</label>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="password" class="form-control" name="new_confirm_password">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
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
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
        {{-- @if (count($tempat) > 0)
      @foreach ($tempat as $key => $tempat)
      <div class="col-md-6 col-sm-12">
          <div class="card">
              <div class="card-content">
                  <img class="card-img-top img-fluid" src="{{asset('images')}}/{{$tempat->image}}"
                      alt="Card image cap" style="height: 20rem" />

                  <div class="card-body">
                      <h4 class="card-title">{{ $tempat->name }}</h4>
                      <p class="card-text">
                          {{ $tempat->deskripsi}}
                      </p>
                      <small class="text-muted">{{ $tempat->alamat}}</small>
                      <p class="card-text">

                      </p>
                      <a class="btn btn-primary block" href="{{ route('kuliner.index') }}"> <span>Check</span></a>
                  </div>
              </div>
          </div>
      </div>
      @endforeach
      @else
      <td>No Data to display</td>
      @endif --}}
        <a href="{{ route('password.request') }}"> <button class="btn btn-outline-warning me-1 mb-1">Lupa Password
            </button></a>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Additional files for the Highslide popup effect -->
    <script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
    <script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var users = <?php echo json_encode($users); ?>;

        Highcharts.chart('container', {
            title: {
                text: {!! json_encode($tempatt->name) !!}
            },
            subtitle: {
                text: ''
            },
            xAxis: {

                categories: {!! json_encode($datee) !!}

            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Pelanggan',
                data: users
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            legend: {
                align: 'left',
                verticalAlign: 'top',
                borderWidth: 0
            },

            tooltip: {
                shared: true,
                crosshairs: true
            },
            plotOptions: {
                // DATA
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function(e) {
                                hs.htmlExpand(null, {
                                    pageOrigin: {
                                        x: e.pageX || e.clientX,
                                        y: e.pageY || e.clientY
                                    },
                                    headingText: this.series.name,
                                    maincontentText: Highcharts.dateFormat(this.x) + ':<br/> ' +
                                        this.y + ' antrian',
                                    width: 200
                                });
                            }
                        }
                    },
                    marker: {
                        lineWidth: 1
                    }
                }
            },
        });
    </script>
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
