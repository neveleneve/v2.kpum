@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    <div class="row my-3">
        <div class="col-lg-1 col-md-4 col-sm-12">
            <a href="{{ route('calon') }}" class="btn btn-sm btn-danger btn-block">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
    </div>
    @if (session('pemberitahuan'))
    <div class="alert bg-{{ session('warna') }} alert-dismissable text-center font-weight-bold" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('pemberitahuan') }}
    </div>
    @endif
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="font-weight-bold text-center">
                        Lihat Data Paslon Nomor Urut {{ $data[0]['no_urut'] }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('updatecalon') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $data[0]['id'] }}">
                        <div class="row">
                            <div class="col-12">
                                <label for="no_urut">Nomor Urut Pasangan Calon</label>
                                <input class="form-control mb-3" type="text" required name="no_urut" id="no_urut" onkeypress="return isNumberKey(event)" value="{{ $data[0]['no_urut'] }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col d-block d-lg-none">
                                        <hr>
                                    </div>
                                    <div class="col-auto">
                                        <h3 class="font-weight-bold">Data Calon Ketua</h3>
                                    </div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                                <label for="ketua">Nama</label>
                                <input class="form-control mb-3" type="text" name="ketua" id="ketua" required onkeypress="return isCharKey(event)" value="{{ $data[0]['ketua'] }}">
                                <label for="nimketua">Nomor Induk Mahasiswa</label>
                                <input class="form-control mb-3" type="text" name="nimketua" id="nimketua" required onkeypress="return isNumberKey(event)" value="{{ $data[0]['nimketua'] }}">
                                <label for="jurusanketua">Jurusan</label>
                                <select class="form-control mb-3" name="jurusanketua" id="jurusanketua" required>
                                    <option value="Teknik Informatika" {{ $data[0]['jurusanketua']=='Teknik Informatika' ? 'selected' : null }}>
                                        Teknik Informatika (IF)
                                    </option>
                                    <option value="Sistem Informasi" {{ $data[0]['jurusanketua']=='Sistem Informasi' ? 'selected' : null }}>
                                        Sistem Informasi (SI)
                                    </option>
                                    <option value="Komputer Akuntansi" {{ $data[0]['jurusanketua']=='Komputer Akuntansi' ? 'selected' : null }}>
                                        Komputer Akuntansi (KA)
                                    </option>
                                </select>
                                <label for="angkatanketua">Angkatan</label>
                                <input class="form-control mb-3" type="text" name="angkatanketua" id="angkatanketua" required onkeypress="return isNumberKey(event)" value="{{ $data[0]['angkatanketua'] }}">
                            </div>
                            <div class="col-md-12 d-block d-lg-none">
                                <hr>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col d-block d-lg-none">
                                        <hr>
                                    </div>
                                    <div class="col-auto">
                                        <h3 class="font-weight-bold">Data Calon Wakil Ketua</h3>
                                    </div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                                <label for="wakil">Nama Calon Wakil Ketua</label>
                                <input class="form-control mb-3" type="text" name="wakil" id="wakil" required onkeypress="return isCharKey(event)" value="{{ $data[0]['wakil'] }}">
                                <label for="nimwakil">Nomor Induk Mahasiswa Calon Wakil Ketua</label>
                                <input class="form-control mb-3" type="text" name="nimwakil" id="nimwakil" required onkeypress="return isNumberKey(event)" value="{{ $data[0]['nimwakil'] }}">
                                <label for="jurusanwakil">Jurusan Calon Wakil Ketua</label>
                                <select class="form-control mb-3" name="jurusanwakil" id="jurusanwakil" required>
                                    <option value="Teknik Informatika" {{ $data[0]['jurusanwakil']=='Teknik Informatika' ? 'selected' : null }}>
                                        Teknik Informatika (IF)
                                    </option>
                                    <option value="Sistem Informasi" {{ $data[0]['jurusanwakil']=='Sistem Informasi' ? 'selected' : null }}>
                                        Sistem Informasi (SI)
                                    </option>
                                    <option value="Komputer Akuntansi" {{ $data[0]['jurusanwakil']=='Komputer Akuntansi' ? 'selected' : null }}>
                                        Komputer Akuntansi (KA)
                                    </option>
                                </select>
                                <label for="angkatanwakil">Angkatan Calon Wakil Ketua</label>
                                <input class="form-control mb-3" type="text" name="angkatanwakil" id="angkatanwakil" required onkeypress="return isNumberKey(event)" value="{{ $data[0]['angkatanwakil'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="visi">Visi Pasangan Calon</label>
                                <textarea class="form-control mb-3" name="visi" id="visi" rows="5" required>{{ $data[0]['visi'] }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="misi">Misi Pasangan Calon</label>
                                <textarea class="form-control mb-3" name="misi" id="misi" rows="10" required>{{ $data[0]['misi'] }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="gambar">Gambar Pasangan Calon</label>
                            </div>
                            <div class="col-12 text-center">
                                <img class="w-50 img-responsive img-thumbnail mb-3" src="{{ asset('images/paslon/' . $data[0]['no_urut'] . '.jpg') }}" alt="">
                            </div>
                            <div class="col-12">
                                <input class="form-control mb-3" type="file" name="gambar" id="gambar">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Perbarui Data">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection