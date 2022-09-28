@extends('admin.layouts2.master')
@section('title','Dana')
@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script> 

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Dana</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola data Dana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dana</a></li>
                        <li class="breadcrumb-item active" aria-current="page">index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

   

{!! Toastr::message() !!}
<div class="row">
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon blue">
                            <i class="fas fa-dollar-sign"></i>
                            {{-- <i class="fas fa-dollar-sign"></i> --}}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Dana</h6>
                        <h6 class="font-extrabold mb-0">Rp. {{ number_format(  $uangutama )}} </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">


                    <div class="stats-icon red">
                        <i class="fas fa-arrow-down"></i>

                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold">Dana Masuk</h6>
                    <h6 class="font-extrabold mb-0">Rp. {{ number_format( $duit) }} </h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">


                    <div class="stats-icon green">
                        {{-- <i class="fas fa-dollar-sign"></i> --}}
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold"> Menunggu </h6>
                    <h6 class="font-extrabold mb-0"> Rp. {{number_format($duit3) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-3 py-4-5">
            <div class="row">
                <div class="col-md-4">


                    <div class="stats-icon purple">
                        {{-- <i class="fas fa-dollar-sign"></i> --}}
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <h6 class="text-muted font-semibold"> Dana Keluar</h6>
                    <h6 class="font-extrabold mb-0">Rp. {{number_format($duit2) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 <!-- list group button & badge start-->
 <section class="list-group-button-badge">
    <div class="row match-height">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pemasukan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <table class="table table-borderless">
                        @foreach ($data as $data)
                        <tr>
                            <td class="col-5">{{  $data->name  }}</td>
                            <td class="col-2 "> x {{ $data->jumlah }}</td>

                            <td class="col-3 "> Rp. {{ number_format($data->harga) }}</td>
                            <td class="col-2">
                                @if ($data->kedatangan == "0")
                                <i class="fas fa-times"></i>
                                @else
                                <i class="fas fa-check"></i>
                                @endif


                            </td>
                            {{-- <td class="col-5 text-center"> x {{ $data->jumlah }}</td> --}}

                        </tr>
                        @endforeach

                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pencairan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p>
                        </p>
                        <form action="{{ route('dana.cair') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tempat_id"  value="{{  $id_tempat }}">
                            <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}">
                            <input  name="jumlah" class="form-control" type="text" id="rupiah" placeholder="Jumlah Uang" required>
                            <br>
                                <button  class="btn btn-outline-primary" type="submit">
                                    Ajukan
                                </button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Histori Pencairan</h4>
            </div>
            <div class="card-content">
                <div class="card-body">

                <table class="table table-borderless" id="tempat">
                    @foreach ($cair as $key => $data)
                    <tr>
                        <td class="col-1">{{  $key+1 }}</td>
                        {{-- <td class="col-3">{{  $data->petugas->name }}</td> --}}
                        <td class="col-3 "> x {{ $data->tempat->name}}</td>

                        <td class="col-3 "> Rp. {{ number_format($data->jumlah) }}</td>
                        <td class="col-3"> {{ $data->created_at->format('d-m-Y') }}

                        </td>
                        <td class="col-5 text-center">
                            @if($data->status == "0")
                            Menunggu
                            @elseif ($data->status == 2)
                            Ditolak
                            @else
                            Disetujui
                            @endif
                        </td>

                    </tr>
                    @endforeach

                </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="col-12 col-md-6 col-lg-6 mb-3">
    <form action="{{ url('awisata/dana') }}" method="post">
        @csrf
        <div class="form-group">
            <h6>Range Waktu</h6>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="daterange" name="daterange" />
                <button class="btn btn-success" type="submit" name="submit" value="table">Search</button>
                {{-- <button class="btn btn-primary" type="submit" name="submit" value="download">Export All</button> --}}
            </div>
        </div>
    </form>
</div>

@if (isset($data))
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

  <div class="section-body">


    <div class="card">

      <div class="card-body">

        <div id="container3"></div>
      </div>

    </div>
  </div>
@else
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

  <div class="section-body">


    <div class="card">
      <div class="card-body">
        <div id="container3"></div>
      </div>

    </div>
  </div>

@endif

  <script type="text/javascript">
    $(function () {

        var start = moment().subtract(29, 'days');
        var end = moment();


        function cb(start, end) {
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#daterange').daterangepicker({
            format: 'YYYY-MM-DD',
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
        $('#daterange').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD'));
        });
    });

</script>


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

{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="{{url('vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{url('vendor/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>


<script type="text/javascript">

Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Data Dana'
    },
    subtitle: {
        text: 'Dana'
    },
    xAxis: {
        categories: [
            'Total Dana',
            'Dana Masuk',
            'Dana Keluar',
        ],
        crosshair: false
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rupiah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>Rp. {point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Total Dana',
        data: {!! json_encode($uangutamaa) !!}

    }, {
        name: 'Dana Masuk',
        data: {!! json_encode($danamasuk) !!}

    }, {
        name: 'Dana Keluar',
        data: {!! json_encode($danakeluar) !!}

    }]
});
</script>



<script type="text/javascript">

    Highcharts.chart('container', {
        title: {
            text: 'Grafik Pencairan'
        },
        subtitle: {
            text:''
        },
         xAxis: {

            categories: {!! json_encode($nominal_gabung) !!}

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
            name: 'Pencairan',
            data: {!! json_encode($pencairan) !!}
            
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
                        click: function (e) {
                            hs.htmlExpand(null, {
                                pageOrigin: {
                                    x: e.pageX || e.clientX,
                                    y: e.pageY || e.clientY
                                },
                                headingText: this.series.name,
                                maincontentText: Highcharts.dateFormat( this.x) + ':<br/> ' +
                                    this.y +  ' antrian',
                                width: 400
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

    Highcharts.chart('container2', {
        title: {
            text: 'Grafik Status Pencairan'
        },
        subtitle: {
            text:''
        },
         xAxis: {

            categories: {!! json_encode($menunggu) !!} 
            

            // categories: {!! json_encode($ditolak) !!}
            // categories: {!! json_encode($disetujui) !!}
            

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
            name: 'Ditolak',
            data: {!! json_encode($nominal_ditolak) !!}

        },
        {
            name: 'Disetujui',
            data: {!! json_encode($nominal_disetujui) !!}
        },
        {
            name: 'Menunggu',
            data: {!! json_encode($nominal_menunggu) !!}
        },
        ],
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
            crosshairs: true,
            pointFormat: '<tr><td style="color:{series.color};padding:0">  {series.name}: </td>' +
            '<td style="padding:0"><b>Rp. {point.y}</b></td></tr>',
        },
        plotOptions: {
            // DATA
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
                            hs.htmlExpand(null, {
                                pageOrigin: {
                                    x: e.pageX || e.clientX,
                                    y: e.pageY || e.clientY
                                },
                                headingText: this.series.name,
                                maincontentText: Highcharts.dateFormat( this.x) + ':<br/> ' +
                                    this.y +  ' antrian',
                                width: 400
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

// $('#show-all-months').click(function() {
//     //chart.xAxis[0].setCategories(['Jan', 'Feb','Mar']);
//     chart.xAxis[0].setExtremes(0,2);
// });
// $('#show-two-months').click(function() {
//     //chart.xAxis[0].setCategories(['Jan', 'Feb']);
//     chart.xAxis[0].setExtremes(0,1);
// });
</script>



<!-- list group button & badge ends -->
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

<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
<script>
    // Simple Datatable
    let table1 = document.querySelector('#tempat');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>

<canvas id="myChart" width="300" height="300"></canvas>
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
