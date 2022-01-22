@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach ($datavisimisi as $item)
                @php
                    $lines = preg_split('/\n|\r\n?/', $item['misi']);
                    // dd($lines);
                @endphp
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <img class="img-thumbnail"
                                        src="{{ asset('images/paslon/' . $item->no_urut . '.jpg') }}" alt="">
                                    <h3 class="font-weight-bold">
                                        {{ $item->ketua }} <br> {{ $item->wakil }}
                                    </h3>
                                    <hr class="d-block d-lg-none">
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <h2 class="h2 font-weight-bold">Visi</h2>
                                    <p class="card-text h5 mb-3">{{ $item->visi }}</p>
                                    <hr>
                                    <h2 class="h2 font-weight-bold">Misi</h2>
                                    @for ($i = 0; $i < count($lines); $i++)
                                        <p class="card-text h5">{{ $lines[$i] }}</p>
                                        <br>
                                    @endfor
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="h2 font-weight-bold">Profil</h4>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <h3 class="h3 font-weight-bold">Calon Presiden Mahasiswa</h3>
                                    <label>Nama</label>
                                    <p>{{ ucfirst($item->ketua) }}</p>
                                    <label>Nomor Induk Mahasiswa</label>
                                    <p>{{ ucfirst($item->nimketua) }}</p>
                                    <label>Jurusan</label>
                                    <p>{{ ucfirst($item->jurusanketua) }}</p>
                                    <label>Angkatan</label>
                                    <p>{{ ucfirst($item->angkatanketua) }}</p>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <h3 class="h3 font-weight-bold">Calon Wakil Presiden Mahasiswa</h3>
                                    <label>Nama</label>
                                    <p>{{ ucfirst($item->wakil) }}</p>
                                    <label>Nomor Induk Mahasiswa</label>
                                    <p>{{ ucfirst($item->nimwakil) }}</p>
                                    <label>Jurusan</label>
                                    <p>{{ ucfirst($item->jurusanwakil) }}</p>
                                    <label>Angkatan</label>
                                    <p>{{ ucfirst($item->angkatanwakil) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
