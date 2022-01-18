@extends('layouts.app')
@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    <div class="row my-3">
        <div class="col-12">
            <button class="btn btn-sm btn-dark btn-block font-weight-bold" href="">
                Tambah Data Pemilih
            </button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Token</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemilih as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ ucwords($item->name) }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->token }}</td>
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