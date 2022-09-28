@extends('admin.layouts2.master')
@section('title','Setting')
@section('content')


<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Setting</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengelola gambar halaman depan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ url('/') }}">welcome</a></li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">index</li> --}}
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

                    <div class="card-header">





                    </div>
                    <div class="card-content">

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-lg table-bordered">
                                <thead>
                                    <tr >

                                        <th scope="col" >#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Ref</th>
                                        <th scope="col">Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($setting)>0)
                                    @foreach($setting as $key=>$value)
                                    <tr>
                                        <td>
                                            {{$key+1}}

                                        </td>
                                        <td>
                                            {{ $value->nama }}
                                        </td>
                                        <td >
                                            @if($value->image == null)
                                            tidak ada
                                            @else
                                            <div class="avatar avatar-xl">
                                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('images')}}/{{$value->image}}">
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $value->ref }}
                                        </td>
                                        <td>
                                            <a  href="{{route('setting.edit',[$value->id])}}" ><button class="btn btn-primary rounded-pill"> <i class="fas fa-edit"></i></button></a>
                                        </td>


                                    </tr>
                                    @endforeach

                                    @else
                                    <td>No item to display</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->

</div>
@endsection
