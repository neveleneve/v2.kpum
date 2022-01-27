@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="font-weight-bold text-center">Cek Data Pemilih</h4>
                </div>
                <div class="card-body text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <form method="post">
                                {{ csrf_field() }}
                                <label for="pencarian">Masukkan NIM / Nama Lengkap</label>
                                <input type="text" class="form-control mb-3" id="pencarian" name="pencarian" value="{{ session('pencarian') ? session('pencarian') : null }}" required>
                                <input type="submit" value="Cari" class="btn btn-dark btn-block">
                            </form>
                        </div>
                    </div>
                    @if (session('datamhs'))
                    <hr>
                    @if (count(session('datamhs')) > 0)
                    @if (session('datamhs')[0]['level'] == 0 || session('datamhs')[0]['level'] == 1)
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h3 class="text-danger font-weight-bold text-center">Data Tidak Ditemukan</h3>
                        </div>
                    </div>
                    @else
                    <div class="row justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h3 class="text-success font-weight-bold text-center">Data Ditemukan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="nim">Nomor Induk Mahasiswa</label>
                            <p>{{ session('datamhs')[0]['username'] }}</p>
                            <label for="nama">Nama Mahasiswa</label>
                            <p>{{ ucwords(session('datamhs')[0]['name']) }}</p>
                            <label for="status">Status Pilih</label>
                            <p>{{ session('datamhs')[0]['status'] == 0 ? 'Belum Memilih' : 'Sudah Memilih' }}
                            </p>
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h3 class="text-danger font-weight-bold text-center">Data Tidak Ditemukan</h3>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection