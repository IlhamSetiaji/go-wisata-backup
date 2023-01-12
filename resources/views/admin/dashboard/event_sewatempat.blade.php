@extends('admin.layouts2.master')
@section('title', 'Admin Event & Sewa Tempat')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    {!! Toastr::message() !!}
    @foreach ($errors->all() as $error)
        {!! Toastr::error($error, 'Error', ['options']) !!}
    @endforeach
    <header class='mb-3'>
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container-fluid">
                <div class="page-heading">
                    <h3> Statistics Data Event dan Tempat Sewa </h3>
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
                            <li><a class="dropdown-item" href="{{ route('atf.peventsewa') }}"><i
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
                        <a href="{{ route('danas.index') }}">
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
                        <a href="/review">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Penilaian</h6>

                                            <h6 class="font-extrabold mb-0"> Review </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="/rekapdata_ep">
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
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="/adminevent">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="fas fa-child"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Event</h6>
                                            <h6 class="font-extrabold mb-0">{{ $event }} </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="/tempatsewa">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Tempat Sewa</h6>
                                            <h6 class="font-extrabold mb-0"> {{ $ts }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <a href="{{ route('atf.event') }}">
                    <div class="card">
                        <div class="card-body py-4 px-5">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img alt="Face 1" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset('images') }}/{{ $tempat->image }}">
                                </div>
                                <div class="ms-3 name">
                                    <h5> {{ $tempat->name }}</h5>
                                    {{ $tempattt->kategori }}, {{ $tempattt->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div id="container"></div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div id="container2"></div>
            </div>
        </div>
    </div>
    <!--Basic Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
        aria-hidden="true">
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
        var users = {!! json_encode($users) !!};

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
                name: 'Pelanggan Event & Sewa Tempat',
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
    <script type="text/javascript">
        var users = [{!! json_encode($total_jan) !!}, {!! json_encode($total_feb) !!}, {!! json_encode($total_mar) !!}, {!! json_encode($total_apr) !!},
            {!! json_encode($total_mei) !!}, {!! json_encode($total_jun) !!}, {!! json_encode($total_juli) !!}, {!! json_encode($total_agus) !!},
            {!! json_encode($total_sept) !!}, {!! json_encode($total_okto) !!}, {!! json_encode($total_nove) !!}, {!! json_encode($total_dese) !!}
        ];

        Highcharts.chart('container2', {
            title: {
                text: [{!! json_encode($tempatt->name) !!},
                    {!! json_encode($thn_sekarang) !!}
                ]
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember"
                ]

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
                name: 'Pelanggan Event & Sewa Tempat',
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
@endsection
