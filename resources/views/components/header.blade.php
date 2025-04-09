<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img class="navbar-brand-img mr-2" src="assets/logo/rie-white.png" alt="Riset Inovasi dan Expo UBD">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown mr-md-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Data Riset &amp; Inovasi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('book') }}">Buku</a>
                        <a class="dropdown-item" href="{{ route('haki') }}">HAKI</a>
                        <a class="dropdown-item" href="{{ route('grant') }}">Hibah Penelitian</a>
                        <a class="dropdown-item" href="{{ route('innovation') }}">Inovasi</a>
                        <a class="dropdown-item" href="{{ route('journal') }}">Jurnal</a>
                        <a class="dropdown-item" href="{{ route('conference') }}">Seminar</a>
                    </div>
                </li>

                <li class="nav-item mr-md-4">
                    <a class="nav-link" href="{{ route('home') }}#innovation">Startup</a>
                </li>
                <li class="nav-item mr-md-4">
                    <a class="nav-link" href="{{ route('home') }}#activity">Aktivitas</a>
                </li>
                <li class="nav-item mr-md-4">
                    <a class="nav-link" href="{{ route('home') }}#about">Tentang</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}"><button type="button"
                            class="btn btn-sm btn-primary btn-block">Login</button></a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"><button type="button"
                            class="btn btn-sm btn-danger btn-block">Admin</button></a>
                </li>
                @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>