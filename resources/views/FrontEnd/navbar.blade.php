<header>
    <nav class="nav container">
        <a href="#" class="nav__logo">Go-Wisata</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="/" class="nav__link {{ $title === 'Home' ? 'active-link' : '' }}">Home</a>
                </li>
                {{-- <li class="nav__item">
                    <a href="#about" class="nav__link">About</a>
                </li>
                <li class="nav__item">
                    <a href="#discover" class="nav__link">Discover</a>
                </li> --}}
                <li class="nav__item">
                    <a href="{{ url('/explore') }}"
                        class="nav__link {{ $title === 'Explore' ? 'active-link' : '' }}">Explore</a>
                </li>
                @guest
                    <li class="nav__item">
                        <a href="{{ route('login') }}" class="nav__link">Login</a>
                    </li>
                @else
                    @if (auth()->check() && auth()->user()->role->id != 5)
                        <li class="nav__item">
                            <a href="{{ route('dashboard') }}" class="nav__link">Dashboard</a>
                        </li>
                    @else
                        <li class="nav__item">
                            <a href="{{ route('pesananku') }}" class="nav__link">Pesananku</a>
                        </li>
                    @endif
                    <li class="nav__item">
                        <a href="{{ url('/profile') }}" class="nav__link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav__link"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf

                        </form>

                    </li>
                @endguest

                <div class="nav__dark">
                    <!-- Theme change button -->
                    <span class="change-theme-name">Dark mode</span>
                    <i class="ri-moon-line change-theme" id="theme-button"></i>
                </div>

                <i class="ri-close-line nav__close" id="nav-close"></i>
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class="ri-function-line"></i>
        </div>
    </nav>
</header>
