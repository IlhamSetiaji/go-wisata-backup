@extends('admin.layouts2.master')
@section('title', 'Daftar Admin')



@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/dripicons/webfont.css')}}"> --}}

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Admin</h3>
                    <p class="text-subtitle text-muted">Halaman untuk mengelola data admin</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/admin') }}">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {!! Toastr::message() !!}
        <div class="page-content">
            <section class="section">

                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">

                        <a href="{{route('admin.create')}}" class="btn bt-info"><i class="fas fa-user-plus"></i> </a>



                    </div> --}}
                            <div class="card-header">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-right">
                                        <li class="breadcrumb-item"> <a href="{{ route('admind.create') }}"
                                                class="btn btn-outline-primary ">Tambah Petugas </a></li>

                                    </ol>
                                </nav>




                            </div>
                            <div class="card-content">

                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="admin">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Email</th>

                                                <th scope="col">Tempat</th>

                                                <th scope="col">Petugas</th>
                                                <th scope="col">Status</th>
                                                <th scope="col"></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($users) > 0)
                                                @foreach ($users as $key => $users)
                                                    <tr>
                                                        {{-- <td>
                                            {{$key+1}}

                                        </td> --}}
                                                        <td>
                                                            <br>
                                                        </td>
                                                        <td>
                                                            {{ $users->petugas_id }}
                                                        </td>
                                                        <td>
                                                            {{ $users->name }}
                                                        </td>
                                                        {{-- <td>
                                            {{ $users->images}}
                                        </td> --}}
                                                        <td>
                                                            @if ($users->image == null)
                                                                <img alt="image" class="mr-3 rounded-circle"
                                                                    width="50" src="{{ asset('images') }}/user.png">
                                                            @else
                                                                <div class="avatar avatar-xl">
                                                                    <img alt="image" class="mr-3 rounded-circle"
                                                                        width="50"
                                                                        src="{{ asset('images') }}/{{ $users->image }}">
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            {{ $users->email }}
                                                        </td>

                                                        <td>
                                                            @if ($users->tempat == null)
                                                                <p>Belum ditempatkan</p>
                                                            @else
                                                                {{ $users->tempat }}
                                                            @endif

                                                        </td>



                                                        @if ($users->role == 'admin')
                                                            <td class="role_name"><span class="btn btn-success">Admin</span>
                                                            </td>
                                                        @endif
                                                        @if ($users->role == 'wisata')
                                                            <td class="role_name"><span class="btn btn-info">Wisata</span>
                                                            </td>
                                                        @endif
                                                        @if ($users->role == 'penginapan')
                                                            <td class="role_name"><span
                                                                    class=" btn btn-primary">Hotel</span></td>
                                                        @endif
                                                        @if ($users->role == 'kuliner')
                                                            <td class="role_name"><span
                                                                    class=" btn btn-secondary">Kuliner</span></td>
                                                        @endif
                                                        @if ($users->role == 'desa')
                                                            <td class="role_name"><span class=" btn btn-light">Desa</span>
                                                            </td>
                                                        @endif
                                                        @if ($users->role == 'event & sewa tempat')
                                                            <td class="role_name"><span class=" btn btn-dark">Event</span>
                                                            </td>
                                                        @endif

                                                        <td>
                                                            @if ($users->id != Auth::user()->id)
                                                                <form
                                                                    action="{{ route('update.status.admin', $users->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button
                                                                        class="{{ $users->status == 1 ? 'btn btn-warning' : 'btn btn-danger' }}">{{ $users->status == 1 ? 'Active' : 'Inactive' }}
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <button class="btn btn-dark">Forbidden</button>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <a href="{{ route('admin.editd', $users->id) }}">
                                                                <span><i class="bi bi-pencil-square"></i></span>
                                                            </a>



                                                            <form class="forms-sample"
                                                                action="{{ route('admin.destroy', $users->id) }}"
                                                                method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></span>
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td>No user to display</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <script></script>
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        {{-- <script src="{{asset('assets/vendors/fontawesome/all.min.js')}}"></script> --}}
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#admin');
            let dataTable = new simpleDatatables.DataTable(table1);
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
