@extends('layouts.app')
@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    <div class="row my-3">
        <div class="col-12">
            <a class="btn btn-sm btn-dark btn-block font-weight-bold" href="">
                Tambah Pasangan Calon
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nomor Urut</th>
                        <th>Nama Pasangan Calon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($calon as $item)
                    <tr>
                        <td>{{ $item->no_urut }}</td>
                        <td>{{ ucwords($item->ketua) .' - '. ucwords($item->wakil) }}</td>
                        <td>{{ $item->level == 0? 'Super Administrator' : 'Administrator' }}</td>
                        <td>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <h2 class="text-center font-weight-bold">Data Kosong</h2>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection