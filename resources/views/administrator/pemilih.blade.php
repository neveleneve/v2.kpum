@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @include('layouts.adminnav')
        @if (session('pemberitahuan'))
            <div class="alert bg-{{ session('warna') }} alert-dismissable text-center font-weight-bold" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('pemberitahuan') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert bg-danger alert-dismissable text-center font-weight-bold" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-3 col-sm-12 my-3">
                <form action="{{ route('pemilih') }}" method="get">
                    <div class="input-group">
                        <input type="search" id="search" name="search" class="form-control form-control-sm"
                            placeholder="Pencarian NIM..." value="{{ isset($_GET['search']) ? $_GET['search'] : null }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-dark">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-9 col-md-12 my-lg-3 mb-3">
                <button class="btn btn-sm btn-dark btn-block font-weight-bold" data-toggle="modal"
                    data-target="#modalpemilih">
                    Tambah Data Pemilih
                </button>
            </div>
            @if (count($pemilih))
                <div class="col-12 mb-3">
                    <a href="{{ route('downloadpemilih') }}"
                        class="btn btn-sm btn-primary btn-block font-weight-bold">Download Data Pemilih</a>
                </div>
            @endif

        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Token</th>
                                <th>Status</th>
                                <th>Tanggal Memilih</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">
                            @forelse ($pemilih as $item)
                                <tr>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-warning font-weight-bold"
                                            href="{{ route('viewpemilih', ['id' => $item->id]) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($item->status == 0)
                                            <a class="btn btn-sm btn-danger font-weight-bold"
                                                href="{{ route('hapuspemilih', ['id' => $item->id]) }}"
                                                onclick="return confirm('Hapus data pemilih dengan nim {{ $item->username }}?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif                                                                                
                                    </td>
                                    <td>{{ ucwords(strtolower($item->name)) }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->token }}</td>
                                    <td>{{ $item->status == 0 ? 'Belum Memilih' : 'Sudah Memilih' }}</td>
                                    <td>{{ $item->vote_time == null ? '-' : date('d/m/Y H:i:s', strtotime($item->vote_time)) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <h2 class="text-center font-weight-bold">Data Kosong</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $pemilih->links() !!}
        </div>
    </div>
    <div class="modal fade" id="modalpemilih">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pemilih</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addpemilih') }}" method="post">
                        {{ csrf_field() }}
                        <input class="form-control mb-3" type="text" name="nama" id="nama" placeholder="Nama Pemilih"
                            required onkeypress="return isCharKey(event)">
                        <input class="form-control mb-3" type="text" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa"
                            required onkeypress="return isNumberKey(event)">
                        <button type="submit" class="btn btn-block btn-dark">Tambah Pemilih</button>
                        <button type="button" data-dismiss="modal" class="btn btn-block btn-primary" data-toggle="modal"
                            data-target="#modalpemilihbanyak">Tambah Banyak Pemilih</button>
                        <a class="btn btn-block btn-light border" data-dismiss="modal">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalpemilihbanyak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah File Data Pemilih</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addpemilihbanyak') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input class="form-control mb-3" type="file" name="file" id="file" required>
                        <button type="submit" class="btn btn-block btn-dark">Input File CSV</button>
                        <button type="button" data-dismiss="modal" class="btn btn-block btn-primary" data-toggle="modal"
                            data-target="#modalpemilih">Kembali</button>
                        <a class="btn btn-block btn-light border" data-dismiss="modal">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function isCharKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return true;
            return false;
        }
    </script>
@endsection
