@extends('layouts.app')
@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    <div class="row my-3">
        <div class="col-12">
            <button class="btn btn-sm btn-dark btn-block font-weight-bold" data-toggle="modal" data-target="#modaltambahcalon">
                Tambah Pasangan Calon
            </button>
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

<div class="modal fade" id="modaltambahcalon">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Calon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahcalon" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            <label for="no_urut">Nomor Urut Pasangan Calon</label>
                            <input class="form-control mb-3" type="text" name="no_urut" id="no_urut" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="ketua">Nama Calon Ketua</label>
                            <input class="form-control mb-3" type="text" name="ketua" id="ketua" required>
                            <label for="nimketua">Nomor Induk Mahasiswa Calon Ketua</label>
                            <input class="form-control mb-3" type="text" name="nimketua" id="nimketua" required>
                            <label for="jurusanketua">Jurusan Calon Ketua</label>
                            <select class="form-control mb-3" name="jurusanketua" id="jurusanketua" required>
                                <option value="Teknik Informatika">Teknik Informatika (IF)</option>
                                <option value="Sistem Informasi">Sistem Informasi (SI)</option>
                                <option value="Komputer Akuntansi">Komputer Akuntansi (KA)</option>
                            </select>
                            <label for="angkatanketua">Angkatan Calon Ketua</label>
                            <input class="form-control mb-3" type="text" name="angkatanketua" id="angkatanketua" required>
                        </div>
                        <div class="col-6">
                            <label for="wakil">Nama Calon Wakil Ketua</label>
                            <input class="form-control mb-3" type="text" name="wakil" id="wakil" required>
                            <label for="nimwakil">Nomor Induk Mahasiswa Calon Wakil Ketua</label>
                            <input class="form-control mb-3" type="text" name="nimwakil" id="nimwakil" required>
                            <label for="jurusanwakil">Jurusan Calon Wakil Ketua</label>
                            <select class="form-control mb-3" name="jurusanwakil" id="jurusanwakil" required>
                                <option value="Teknik Informatika">Teknik Informatika (IF)</option>
                                <option value="Sistem Informasi">Sistem Informasi (SI)</option>
                                <option value="Komputer Akuntansi">Komputer Akuntansi (KA)</option>
                            </select>
                            <label for="angkatanwakil">Angkatan Calon Wakil Ketua</label>
                            <input class="form-control mb-3" type="text" name="angkatanwakil" id="angkatanwakil" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="visi">Visi Pasangan Calon</label>
                            <textarea class="form-control mb-3" name="visi" id="visi" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="misi">Misi Pasangan Calon</label>
                            <textarea class="form-control mb-3" name="misi" id="misi" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="gambar">Gambar Pasangan Calon</label>
                            <input class="form-control mb-3" type="file" name="gambar" id="gambar" required>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Tambah Data">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection