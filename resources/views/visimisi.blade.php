@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($datavisimisi as $item)
        @php
        $lines = preg_split('/\n|\r\n?/', $item['misi']);
        // dd($lines);
        @endphp
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <img class="img-thumbnail" src="{{ asset('images/paslon/' . $item->no_urut . '.jpg') }}" alt="">
                    <h3 class="font-weight-bold">
                        {{ $item->ketua }} <br> {{ $item->wakil }}
                    </h3>
                </div>
                <hr>
                {{-- visi --}}
                <div class="card-header">
                    <button class="btn btn-link btn-block text-left text-dark collapsed" type="button" data-toggle="collapse" data-target="#visipaslon{{ $item->no_urut }}">
                        <h3 class="h3 font-weight-bold">
                            Visi
                        </h3>
                    </button>
                </div>
                <div id="visipaslon{{ $item->no_urut }}" class="collapse">
                    <div class="card-body">
                        <p class="card-text h5 mb-3">{{ $item->visi }}</p>
                    </div>
                </div>
                {{-- misi --}}
                <div class="card-header">
                    <button class="btn btn-link btn-block text-left text-dark collapsed" type="button" data-toggle="collapse" data-target="#misipaslon{{ $item->no_urut }}">
                        <h3 class="h3 font-weight-bold">Misi</h3>
                    </button>
                </div>
                <div id="misipaslon{{ $item->no_urut }}" class="collapse">
                    <div class="card-body">
                        <ul class="fa-ul">
                            @for ($i = 0; $i < count($lines); $i++) 
                                <li>
                                    <span class="fa-li">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    {{ $lines[$i] }}
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
                {{-- profil --}}
                <div class="card-header">
                    <button class="btn btn-link btn-block text-left text-dark collapsed" type="button" data-toggle="collapse" data-target="#profilpaslon{{ $item->no_urut }}">
                        <h3 class="h3 font-weight-bold">Profil</h3>
                    </button>
                </div>
                <div id="profilpaslon{{ $item->no_urut }}" class="collapse">
                    <div class="card-body">
                        <h4 class="h4 font-weight-bold">Calon Presiden Mahasiswa</h4>
                        <label>Nama</label>
                        <p>{{ ucfirst($item->ketua) }}</p>
                        <label>Nomor Induk Mahasiswa</label>
                        <p>{{ ucfirst($item->nimketua) }}</p>
                        <label>Jurusan</label>
                        <p>{{ ucfirst($item->jurusanketua) }}</p>
                        <label>Angkatan</label>
                        <p>{{ ucfirst($item->angkatanketua) }}</p>
                        <h4 class="h3 font-weight-bold">Calon Wakil Presiden Mahasiswa</h4>
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
        @endforeach
    </div>
</div>
@endsection