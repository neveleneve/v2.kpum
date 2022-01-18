<nav id="nav" class="main-header navbar navbar-expand-lg navbar-light navbar-dark">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="{{ route('welcome') }}" class="navbar-brand">
            <img src="{{ asset('/admin/dist/img/kpum.png') }}" class="brand-image" style="opacity: .8">
            <span class="brand-text font-weight-bold">KP</span><span class="brand-text font-weight-light">UM</span>
        </a>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link {{ Request::is('/') ? 'font-weight-bold' : null }}">Beranda</a>
                </li>
                @if ($setting['hasil suara'][0] == 1)
                @if ($jumlahcalon > 0)
                <li class="nav-item">
                    <a href="{{ route('hasil') }}" class="nav-link {{ Request::is('hasil-pemilihan') ? 'font-weight-bold' : null }}">Hasil Pemilihan</a>
                </li>
                @endif
                @endif
                @if ($jumlahcalon > 0)
                <li class="nav-item">
                    <a href="{{ route('visimisi') }}" class="nav-link {{ Request::is('visi-misi') ? 'font-weight-bold' : null }}">Visi dan Misi</a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('cekvoter') }}" class="nav-link {{ Request::is('cek-voter') ? 'font-weight-bold' : null }}">Cek Data Pemilih</a>
                </li>
                @auth
                @if (Auth::user()->level == 0 || Auth::user()->level == 1)
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('administrator*') ? 'font-weight-bold' : null }}">
                        Administrator
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('vote') }}" class="nav-link {{ Request::is('vote') ? 'font-weight-bold' : null }}">Vote Now!</a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
        @auth
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item nav-item-right">
                <a class="nav-link" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fas fa-sign-out-alt"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        @else
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="{{ Request::is('login') ? 'fas' : 'far' }} fa-user"></i>
                </a>
            </li>
        </ul>
        @endauth
    </div>
</nav>