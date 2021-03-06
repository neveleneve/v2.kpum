@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    @if (session('pemberitahuan'))
    <div class="alert bg-{{ session('warna') }} alert-dismissable text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('pemberitahuan') }}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-3 col-sm-12 my-3">
            <form action="{{ route('administrator') }}" method="get">
                <div class="input-group">
                    <input type="search" id="search" name="search" class="form-control form-control-sm"
                        placeholder="Pencarian username..."
                        value="{{ isset($_GET['search']) ? $_GET['search'] : null }}">
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
                data-target="#modaltambahadmin">
                Tambah Administrator
            </button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        @forelse ($panitia as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ ucwords($item->name) }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->level == 0 ? 'Super Administrator' : 'Administrator' }}</td>
                            <td>{{ $item->status == 0 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td class="text-center">
                                @if ($item->id != Auth::user()->id)
                                @if ($item->level != 0)
                                <a href="{{ route('viewadministrator', ['id'=> $item->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    Lihat Data
                                </a>
                                <a href="{{ route('resetadministrator', ['id'=> $item->id]) }}"
                                    class="btn btn-sm btn-warning"
                                    onclick="return confirm('Reset Password Administrator {{ $item->username }}?')">
                                    Reset Password
                                </a>
                                @if ($item->status == 1)
                                <a href="{{ route('activateadministrator', ['id'=> $item->id]) }}"
                                    class="btn btn-sm btn-success"
                                    onclick="return confirm('Aktifkan Administrator {{ $item->username }}?')">
                                    Aktifkan
                                </a>
                                @elseif ($item->status == 0)
                                <a href="{{ route('deactivateadministrator', ['id'=> $item->id]) }}"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Non-Aktifkan Administrator {{ $item->username }}?')">
                                    Non-Aktifkan
                                </a>
                                @endif
                                @endif
                                @else
                                <a href="{{ route('pengaturan') }}" class="btn btn-sm btn-info">
                                    Pengaturan
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <h2 class="text-center font-weight-bold">Data Kosong</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahadmin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('addadministrator') }}" method="POST">
                    {{ csrf_field() }}
                    <input class="form-control mb-3" type="text" placeholder="Nama Lengkap" id="nama" name="nama"
                        required>
                    <input class="form-control mb-3" type="text" placeholder="Username" id="username" name="username"
                        required>
                    <select name="level" id="level" class="form-control mb-3" required>
                        <option value="" selected disabled hidden>Level Admin</option>
                        <option value="0">Super Administrator</option>
                        <option value="1">Administrator</option>
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-sm btn-danger btn-block text-light" data-dismiss="modal">Kembali</a>
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-sm btn-primary btn-block" value="Tambah Data Admin">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection