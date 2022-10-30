<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
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

<body>

    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/go.png') }}"
                                    alt="Logo" width="230px" srcset=""></a>

                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block">
                                <i class="bi bi-house-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item  {{ request()->is('dashboard*') ? 'active' : '' }}">
                            <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @if (auth()->check() && auth()->user()->role->name === 'desa')
                            Tempat
                            <li class="sidebar-item  {{ request()->is('adesa/desa*') ? 'active' : '' }}">
                                <a href="{{ route('desa.index') }}" class='sidebar-link'>
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>Desa</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('adesa/tempatd*') ? 'active' : '' }}">
                                <a href="{{ route('tempat.indexd') }}" class='sidebar-link'>
                                    <i class="fas fa-location-arrow"></i>
                                    <span>Tempat</span>
                                </a>
                            </li>

                            <li class="sidebar-item  {{ request()->is('adesa/admind*') ? 'active' : '' }}">
                                <a href="{{ route('admind.index') }}" class='sidebar-link'>
                                    <i class="fas fa-user-tie"></i>
                                    <span>Admin</span>
                                </a>
                            </li>
                            <hr>
                            <li class="sidebar-item  {{ request()->is('adesa/rekapd*') ? 'active' : '' }}">
                                <a href="{{ route('rekapd.index') }}" class='sidebar-link'>
                                    <i class="far fa-file"></i>
                                    <span>Rekap Data</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('adesa/budgeting*') ? 'active' : '' }}">
                                <a href="{{ route('budget.index') }}" class='sidebar-link'>
                                    <i class="bi bi-cash"></i>
                                    <span>E-Budgeting</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->check() && auth()->user()->role->name === 'kuliner')
                            <hr>
                            Data
                            {{-- <li class="sidebar-item  {{ request()->is('akuliner/kategorikm*') ? 'active' : '' }}">
                            <a href="{{ route('kategorikm.index_kategori_km') }}" class='sidebar-link'>
                                <i class="fas fa-list-alt"></i>
                                <span>Kategori Kuliner dan Katalog Merchandise</span>
                            </a>
                        </li> --}}
                            <li class="sidebar-item  {{ request()->is('akuliner/kuliner*') ? 'active' : '' }}">
                                <a href="{{ route('kuliner.index') }}" class='sidebar-link'>
                                    <i class="fas fa-utensils"></i>
                                    <span>Makanan / Minuman</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('akuliner/tempatk*') ? 'active' : '' }}">
                                <a href="{{ route('atf.kuliner') }}" class='sidebar-link'>
                                    {{-- <i class="bi bi-person-badge-fill"></i> --}}
                                    <i class="fas fa-store-alt"></i>
                                    <span>Tempat</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('akuliner/rekapk*') ? 'active' : '' }}">
                                <a href="{{ route('rekapk.index') }}" class='sidebar-link'>
                                    <i class="fas fa-file-invoice"></i>
                                    {{-- <i class="bi bi-house-fill"></i> --}}
                                    <span>Rekap Data</span>
                                </a>
                            </li>
                            <hr>
                            Pemesanan
                            {{-- <li class="sidebar-item  {{ (request()->is('wisata/tiket*')) ? 'active' : '' }}">
                        <a href="{{ route('tiket.index') }}" class='sidebar-link'>

                            <i class="fas fa-ticket-alt"></i>
                            <span>Tiket</span>
                        </a>
                    </li> --}}
                            <li class="sidebar-item  {{ request()->is('akuliner/checkk*') ? 'active' : '' }}">
                                <a href="{{ route('checkk.index') }}" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Check</span>
                                </a>
                            </li>

                            <li class="sidebar-item  {{ request()->is('akuliner/todayk*') ? 'active' : '' }}">
                                <a href="{{ route('todaykuliner.index') }}" class='sidebar-link'>
                                    <i class="far fa-clock"></i>
                                    <span>Today</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('akuliner/orderk*') ? 'active' : '' }}">
                                <a href="{{ route('orderk.index') }}" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Order</span>
                                </a>
                            </li>

                            <hr>
                            Pemasukan
                            <li class="sidebar-item  {{ request()->is('akuliner/dana*') ? 'active' : '' }}">
                                <a href="{{ route('danak.index') }}" class='sidebar-link'>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Dana</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-item  {{ request()->is('akuliner/reviewk*') ? 'active' : '' }}">
                                <a href="{{ route('review.kuliner') }}" class='sidebar-link'>
                                    <i class="fas fa-star
                                .ik-star"></i>
                                    <span>Penilaian</span>
                                </a>
                            </li> --}}
                        @endif
                        @if (auth()->check() && auth()->user()->role->name === 'wisata')
                            {{-- <li class="sidebar-item  {{ request()->is('kegiatan*') ? 'active' : '' }}">
                                <a href="{{ url('/kegiatan') }}" class='sidebar-link'>
                                    <i class="fas fa-child "></i>
                                    <span>Kegiatan</span>
                                </a>
                            </li> --}}
                            <hr>
                            Pemesanan
                            <li class="sidebar-item  {{ request()->is('wisata/order*') ? 'active' : '' }}">
                                <a href="{{ route('order.index') }}" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Order</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('wisata/jadwalcamp*') ? 'active' : '' }}">
                                <a href="{{ route('jadwalcamp.index') }}" class='sidebar-link'>
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Camp</span>
                                </a>
                            </li>
                            <hr>
                            Pengecekan

                            <li class="sidebar-item  {{ request()->is('wisata/checkw*') ? 'active' : '' }}">
                                <a href="{{ route('checkw.index') }}" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Tiket Wisata</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('wisata/checkwahana*') ? 'active' : '' }}">
                                <a href="{{ route('checkwahana.index') }}" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Tiket Wahana</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('wisata/checkwahana*') ? 'active' : '' }}">
                                <a href="{{ route('checkwahana.index') }}" class='sidebar-link'>
                                    {{-- <i class="bi bi-person-badge-fill"></i> --}}
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Paket Tiket</span>
                                </a>
                            </li>
                            <hr>
                            Pemasukan
                            <li class="sidebar-item  {{ request()->is('wisata/dana*') ? 'active' : '' }}">
                                <a href="{{ route('dana.index') }}" class='sidebar-link'>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Dana</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('wisata/topup*') ? 'active' : '' }}">
                                <a href="{{ route('topup.index') }}" class='sidebar-link'>
                                    <i class="fas fa-money-check"></i>
                                    <span>Topup</span>
                                </a>
                            </li>
                            <hr>
                            Tempat
                            <li class="sidebar-item  {{ request()->is('wisata/tempatf*') ? 'active' : '' }}">
                                <a href="{{ route('tempatf.index') }}" class='sidebar-link'>
                                    <i class="fas fa-location-arrow"></i>
                                    <span>Kelola</span>
                                </a>
                            </li>
                            <hr>
                            Data
                            <li class="sidebar-item  {{ request()->is('wisata/camping*') ? 'active' : '' }}">
                                <a href="{{ route('camping.index') }}" class='sidebar-link'>
                                    <i class="fas fa-campground"></i>
                                    <span>Camp</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('wisata/wahana*') ? 'active' : '' }}">
                                <a href="{{ route('wahana.index') }}" class='sidebar-link'>
                                    <i class="fas fa-gamepad"></i>
                                    <span>Wahana</span>
                                </a>
                            </li>

                            <li class="sidebar-item  {{ request()->is('wisata/wisata*') ? 'active' : '' }}">
                                <a href="{{ route('wisata.index') }}" class='sidebar-link'>
                                    <i class="far fa-map"></i>
                                    <span>Wisata</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('wisata/rekapw*') ? 'active' : '' }}">
                                <a href="{{ route('rekapw.index') }}" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Rekap Data</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->check() && auth()->user()->role->name === 'penginapan')
                            <li class="sidebar-item  {{ request()->is('penginapan/booking*') ? 'active' : '' }}">
                                <a href="{{ route('booking.index') }}" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Booking</span>
                                </a>
                            </li>
                            <hr>
                            Pesanan Kamar Hotel
                            <li class="sidebar-item  {{ request()->is('penginapan/checkp*') ? 'active' : '' }}">
                                <a href="{{ route('checkp.index') }}" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Check</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('penginapan/jadwalkamar*') ? 'active' : '' }}">
                                <a href="{{ route('jadwalkamar.index') }}" class='sidebar-link'>
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Kamar</span>
                                </a>
                            </li>
                            <hr>
                            Pesanan Villa
                            <li class="sidebar-item  {{ request()->is('penginapan/check_villa*') ? 'active' : '' }}">
                                <a href="/penginapan/check_villa" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Check</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-item  {{ request()->is('penginapan/todaypesanvilla*') ? 'active' : '' }}">
                                <a href="/penginapan/todaypesanvilla" class='sidebar-link'>
                                    <i class="far fa-clock"></i>
                                    <span>Today</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-item  {{ request()->is('penginapan/order_villa*') ? 'active' : '' }}">
                                <a href="/penginapan/order_villa" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Orders</span>
                                </a>
                            </li> --}}
                            <hr>
                            Pemasukan
                            <li class="sidebar-item  {{ request()->is('penginapan/dana*') ? 'active' : '' }}">
                                <a href="{{ route('danap.index') }}" class='sidebar-link'>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Dana</span>
                                </a>
                            </li>
                            <hr>
                            Manajemen Data
                            <li class="sidebar-item  {{ request()->is('penginapan/hotel*') ? 'active' : '' }}">
                                <a href="{{ route('hotel.index') }}" class='sidebar-link'>
                                    <i class="fas fa-bed"></i>
                                    <span>Hotel</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-item  {{ request()->is('penginapan/kamar*') ? 'active' : '' }}">
                                <a href="{{ route('kamar.index') }}" class='sidebar-link'>
                                    <i class="fas fa-bed"></i>

                                    <span>Kamar</span>
                                </a>
                            </li> --}}
                            <li class="sidebar-item  {{ request()->is('penginapan/villa*') ? 'active' : '' }}">
                                <a href="/penginapan/villa" class='sidebar-link'>
                                    <i class="fas fa-home .ik-home"></i>
                                    <span>Villa</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('penginapan/tempatp*') ? 'active' : '' }}">
                                <a href="{{ route('atf.penginapan') }}" class='sidebar-link'>
                                    {{-- <i class="bi bi-person-badge-fill"></i> --}}
                                    <i class="fas fa-store-alt"></i>
                                    <span>Tempat</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('penginapan/rekapp*') ? 'active' : '' }}">
                                <a href="{{ route('rekapp.index') }}" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    {{-- <i class="bi bi-house-fill"></i> --}}
                                    <span>Rekap Data</span>
                                </a>
                            </li>

                            <hr>
                        @endif

                        @if (auth()->check() && auth()->user()->role->name === 'admin')
                            <li class="sidebar-item  {{ request()->is('admin/adana*') ? 'active' : '' }}">
                                <a href="{{ route('admin.dana') }}" class='sidebar-link'>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Konfirmasi Dana</span>
                                </a>
                            </li>
                            <hr>
                            <li class="sidebar-item  {{ request()->is('admin/tempat*') ? 'active' : '' }}">
                                <a href="{{ route('tempat.index') }}" class='sidebar-link'>
                                    <i class="fas fa-map-marker"></i>
                                    <span>Tempat</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('admin/pelanggan*') ? 'active' : '' }}">
                                <a href="{{ route('pelanggan.index') }}" class='sidebar-link'>
                                    <i class="fas fa-user"></i>
                                    <span>Pelanggan</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('admin/admin*') ? 'active' : '' }}">
                                <a href="{{ route('admin.index') }}" class='sidebar-link'>
                                    <i class="fas fa-user-tie"></i>
                                    <span>Admin</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('admin/setting*') ? 'active' : '' }}">
                                <a href="{{ route('setting.index') }}" class='sidebar-link'>
                                    <i class="fas fa-cogs"></i>
                                    <span>Setting</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->check() && auth()->user()->role->name === 'event & sewa tempat')
                            <li class="sidebar-item  {{ request()->is('booking/eventtempatsewa*') ? 'active' : '' }}">
                                <a href="/booking/eventtempatsewa" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Booking</span>
                                </a>
                            </li>
                            <hr>
                            Manajemen Data
                            <li class="sidebar-item  {{ request()->is('kategorievent*') ? 'active' : '' }}">
                                <a href="/kategorievent" class='sidebar-link'>
                                    <i class="fas fa-film
                                    .ik-film"></i>
                                    <span>Kategori Event</span>
                                </a>
                            </li>

                            <li class="sidebar-item  {{ request()->is('adminevent*') ? 'active' : '' }}">
                                <a href="/adminevent" class='sidebar-link'>
                                    <i class="far fa-image
                                    .ik-image"></i>
                                    <span>Event</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('tempatsewa*') ? 'active' : '' }}">
                                <a href="/tempatsewa" class='sidebar-link'>
                                    <i class="fas fa-home
                                    .ik-home"></i>
                                    <span>Tempat Sewa</span>
                                </a>
                            </li>
                            <hr>
                            Pemesanan Event
                            <li class="sidebar-item  {{ request()->is('check_order*') ? 'active' : '' }}">
                                <a href="/check_order" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Check</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('todaypesanevent*') ? 'active' : '' }}">
                                <a href="/todaypesanevent" class='sidebar-link'>
                                    <i class="far fa-clock"></i>
                                    <span>Today</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-item  {{ request()->is('bookingevent*') ? 'active' : '' }}">
                                <a href="/bookingevent" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Orders</span>
                                </a>
                            </li> --}}
                            <hr>
                            Pemesanan Tempat Sewa
                            <li class="sidebar-item  {{ request()->is('check_tempatsewa*') ? 'active' : '' }}">
                                <a href="/check_tempatsewa" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Check</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('jadwalsewa*') ? 'active' : '' }}">
                                <a href="/jadwalsewa" class='sidebar-link'>
                                    <i class="far fa-clock"></i>
                                    <span>Jadwal Sewa</span>
                                </a>
                            </li>
                            <hr>
                            {{-- Pemesanan Villa
                            <li class="sidebar-item  {{ request()->is('check_Villa*') ? 'active' : '' }}">
                                <a href="/check_Villa" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Check</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('todaypesanVilla*') ? 'active' : '' }}">
                                <a href="/todaypesanVilla" class='sidebar-link'>
                                    <i class="far fa-clock"></i>
                                    <span>Today</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('BookingVilla*') ? 'active' : '' }}">
                                <a href="/BookingVilla" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <hr> --}}
                            {{-- Pemasukan
                            <li class="sidebar-item  {{ request()->is('akuliner/kuliner*') ? 'active' : '' }}">
                                <a href="{{ route('kuliner.index') }}" class='sidebar-link'>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Dana Event</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('akuliner/tempatk*') ? 'active' : '' }}">
                                <a href="{{ route('atf.kuliner') }}" class='sidebar-link'>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Dana Penyewaan Tempat</span>
                                </a>
                            </li>
                            <hr> --}}
                            {{-- Penilaian
                            <li class="sidebar-item  {{ request()->is('reviewevent*') ? 'active' : '' }}">
                                <a href="/reviewevent" class='sidebar-link'>
                                    <i class="fas fa-thumbs-up
                                    .ik-thumbs-up"></i>
                                    <span>Testimoni Event</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('reviewVilla*') ? 'active' : '' }}">
                                <a href="/reviewVilla" class='sidebar-link'>
                                    <i class="fas fa-star
                                    .ik-star"></i>
                                    <span>Testimoni Penyewaan Tempat</span>
                                </a>
                            </li> --}}
                            {{-- <hr> --}}
                            {{-- <li class="sidebar-item  {{ request()->is('check*') ? 'active' : '' }}">
                                <a href="/check_ep" class='sidebar-link'>
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>Pemesanan</span>
                                </a>
                            </li> --}}
                            <li class="sidebar-item  {{ request()->is('rekapdata*') ? 'active' : '' }}">
                                <a href="/rekapdata_ep" class='sidebar-link'>
                                    <i class="fas fa-inbox"></i>
                                    <span>Rekap Data</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->is('review*') ? 'active' : '' }}">
                                <a href="/review" class='sidebar-link'>
                                    <i class="fas fa-star
                                    .ik-star"></i>
                                    <span>Ulasan Pengguna</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a class='sidebar-link' href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        </form>





                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
