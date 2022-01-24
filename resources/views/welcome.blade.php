@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (session('pemberitahuan'))
            <div class="alert bg-{{ session('warna') }} alert-dismissable text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('pemberitahuan') }}
            </div>
        @endif
        @if ($jumlahcarousel > 0)
            @if ($setting['carousel'][0] == 1)
                <section class="row">
                    <div class="col-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @for ($i = 0; $i < $jumlahcarousel; $i++)
                                    @if ($i == 0)
                                        <div class="carousel-item active img-fluid">
                                            <img class="d-block w-100"
                                                src="{{ asset('/images/carousel/' . $filecarousel[$i]) }}">
                                        </div>
                                    @else
                                        <div class="carousel-item img-fluid">
                                            <img class="d-block w-100"
                                                src="{{ asset('/images/carousel/' . $filecarousel[$i]) }}">
                                        </div>
                                    @endif
                                @endfor
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <h4 class="text-center font-weight-bold d-none d-lg-block mt-3">KOMISI PEMILIHAN UMUM MAHASISWA</h4>
                        <h4 class="text-center mb-3 font-weight-light d-none d-lg-block">SEKOLAH TINGGI TEKNOLOGI INDONESIA
                            TANJUNGPINANG</h4>
                    </div>
                </section>
                <div class="dropdown-divider"></div>
            @endif
        @endif
        @if ($setting['waktupemilihan'][0] == 1)
            <section class="row justify-content-center">
                <div class="col-12">
                    <h1 class="text-center font-weight-bold">
                        Tanggal Pemilihan
                    </h1>
                    <h3 class="text-center">
                        {{ date('j', strtotime($waktu['Buka'][0])) . ' ' . App\Http\Controllers\AdminController::namabulan(date('n', strtotime($waktu['Buka'][0]))) . ' ' . date('Y H:i', strtotime($waktu['Buka'][0])) }}
                        -
                        {{ date('j', strtotime($waktu['Tutup'][0])) . ' ' . App\Http\Controllers\AdminController::namabulan(date('n', strtotime($waktu['Tutup'][0]))) . ' ' . date('Y H:i', strtotime($waktu['Tutup'][0])) }}
                    </h3>
                </div>
            </section>
            <div class="dropdown-divider"></div>
        @endif
        @if ($jumlahcalon > 0)
            <section class="row mb-2 justify-content-center">
                <div class="col-12">
                    <h1 class="text-center brand-text font-weight-bold mb-3">Pasangan Calon</h1>
                </div>
                @foreach ($datacalon as $item)
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <img class=" card-img-top" src="{{ asset('images/paslon/' . $item->no_urut . '.jpg') }}"
                                alt="Card image">
                            <div class="card-body text-center">
                                <h3 class="h3 font-weight-bold">
                                    {{ $item->ketua }} - {{ $item->wakil }}
                                </h3>
                                @if ($setting['hasilsuara'][0] == 1)
                                    <p class="h5 card-text font-weight-bold">
                                        Persentase Suara :
                                        {{ App\Http\Controllers\GeneralController::suarapersonal($item->no_urut) == 0 ? 0 : round(App\Http\Controllers\GeneralController::suarapersonal($item->no_urut) / $datasuaramasuk, 4) * 100 }}
                                        % ({{ App\Http\Controllers\GeneralController::suarapersonal($item->no_urut) }}
                                        Suara)
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-4 my-3">
                    <a href="{{ route('visimisi') }}" class="btn btn-dark btn-block font-weight-bold">Visi dan Misi</a>
                </div>
            </section>
            <div class="dropdown-divider"></div>
        @endif
        @if ($jumlahcarapilih > 0)
            @if ($setting['carapilih'][0] == 1)
                <section class="row justify-content-center">
                    <div class="col-6">
                        <h1 class="text-center brand-text font-weight-bold mb-3">Informasi</h1>
                    </div>
                    <div class="col-12 text-center">
                        @for ($i = 0; $i < $jumlahcarapilih; $i++)
                            <img class="img-fluid img-thumbnail mb-3"
                                src="{{ asset('/images/carapilih/' . $filecarapilih[$i]) }}">
                        @endfor
                    </div>
                </section>
                <div class="dropdown-divider"></div>
            @endif
        @endif

        <section class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center brand-text font-weight-bold mb-3">Tentang<a class="d-none d-md-inline"> Komisi
                        Pemilihan Umum Mahasiswa STT Indonesia Tanjungpinang</a></h1>
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img class="mx-auto img-thumbnail" src="{{ asset('/admin/dist/img/kpum.png') }}" alt="">
                            </div>
                            <p class="text-center">
                                <strong>
                                    Komisi Pemilihan Umum Mahasiswa Sekolah Tinggi Teknologi Indonesia Tanjungpinang
                                </strong>
                                merupakan badan yang dibentuk oleh Majelis Permusywaratan Mahasiswa Sekolah Tinggi
                                Teknologi Indonesia Tanjungpinang dalam rangka melakukan pemilihan Presiden dan
                                Wakil Presiden Mahasiswa selaku Ketua Badan Eksekutif Mahasiswa Sekolah Tinggi Teknologi
                                Indonesia Tanjungpinang
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
