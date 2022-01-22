@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (session('pemberitahuan'))
            <div class="alert bg-{{ session('warna') }} alert-dismissable text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('pemberitahuan') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h1 class="font-weight-bold text-center">PEMILIHAN UMUM MAHASISWA</h1>
                <h2 class="font-weight-bold text-center">Sekolah Tinggi Teknologi Indonesia {{ date('Y') }}</h2>
            </div>
        </div>
        <div class="dropdown-divider mb-3"></div>
        @if (Auth::user()->status == 0)
            <div class="row">
                @foreach ($datacalon as $item)
                    <div class="col-lg col-md-12">
                        <div class="card">
                            <form method="post"
                                onclick="return confirm('Yakin memilih pasangan calon nomor urut {{ $item->no_urut }}?')">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->no_urut }}">
                                <div class="card-header bg-dark">
                                    <h4 class="h4 text-center font-weight-bold">
                                        Pasangan Calon {{ $item->no_urut }}
                                    </h4>
                                </div>
                                <div class="text-center card-body">
                                    <img class="img-fluid img-thumbnail"
                                        src="{{ asset('images/paslon/' . $item->no_urut . '.jpg') }}">
                                    <h3 class="text-center font-weight-bold">
                                        {{ $item->ketua }} <br> {{ $item->wakil }}
                                    </h3>
                                    <button class="btn btn-dark stretched-link">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                @foreach ($datacalon as $item)
                    <div class="col-lg col-md-12">
                        <div class="card">

                            <div class="card-header bg-dark">
                                <h4 class="h4 text-center font-weight-bold">
                                    Pasangan Calon {{ $item->no_urut }}
                                </h4>
                            </div>
                            <div class="text-center card-body">
                                <img class="img-fluid img-thumbnail"
                                    src="{{ asset('images/paslon/' . $item->no_urut . '.jpg') }}">
                                <h3 class="text-center font-weight-bold">
                                    {{ $item->ketua }} <br> {{ $item->wakil }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
