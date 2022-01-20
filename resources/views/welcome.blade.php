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
                <section id="beranda" class="row">
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
        @if ($jumlahcalon > 0)
            @if ($setting['hasilsuara'][0] == 1)
                <?php $warnacok = ['', 'dark', 'info', 'warning', 'primary', 'danger']; ?>
                <section id="hasil" class="row mb-2 justify-content-center">
                    @foreach ($datacalon as $item)
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-{{ $warnacok[$item->no_urut] }} elevation-1"><i
                                        class="fas fa-user-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pasangan Nomor Urut {{ $item->no_urut }}</span>
                                    <span class="info-box-number">{{ $item->ketua }}</span>
                                    <span class="info-box-number">{{ $item->wakil }}</span>
                                </div>
                                <div class="info-box-footer">
                                    Persentase Suara :
                                    {{ $datasuarapersonal[$item->no_urut] == 0 ? 0 : round($datasuarapersonal[$item->no_urut] / $suaramasuk, 4) * 100 }}
                                    % ({{ $datasuarapersonal[$item->no_urut] }} Suara)
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>
                <div class="dropdown-divider"></div>
            @endif
        @endif
        @if ($setting['carapilih'][0] == 1)
            <section id="cara" class="row justify-content-center">
                <div class="col-6">
                    <h1 class="text-center brand-text font-weight-bold mb-3">Cara Memilih</h1>
                </div>
                <div class="col-12 text-center">
                    @for ($i = 0; $i < $jumlahcarapilih; $i++)
                        <img class="img-fluid mb-3" src="{{ asset('/images/carapilih/' . $filecarapilih[$i]) }}">
                    @endfor
                </div>
            </section>
            <div class="dropdown-divider"></div>
        @endif
        <section id="tentang" class="row justify-content-center">
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
