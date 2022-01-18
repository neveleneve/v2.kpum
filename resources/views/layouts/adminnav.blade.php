<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="nav nav-tabs justify-content-center text-dark">
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::is('administrator') ? 'active font-weight-bold' : null }}" href="{{ route('home') }}">Dashboard</a>
            </li>
            @if (Auth::user()->level == 0)
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::is('administrator/panitia') ? 'active font-weight-bold' : null }}" href="{{ route('administrator') }}">Data Administrator</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::is('administrator/calon') ? 'active font-weight-bold' : null }}" href="{{ route('calon') }}">Data Calon</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::is('administrator/pemilih') ? 'active font-weight-bold' : null }}" href="{{ route('pemilih') }}">Data Pemilih</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::is('administrator/pengaturan') ? 'active font-weight-bold' : null }}" href="{{ route('pengaturan') }}">Pengaturan</a>
            </li>
        </ul>
    </div>
</div>