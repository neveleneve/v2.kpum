@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if (session('pemberitahuan'))
    <div class="alert bg-{{session('warna')}} alert-dismissable text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('pemberitahuan')}}
    </div>
    @endif
    @if ($setting['carousel'][0] == 1)
    <section id="beranda" class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset('/images/carousel/1.JPG')}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('/images/carousel/2.JPG')}}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('/images/carousel/3.JPG')}}" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
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
    {{-- @if ($setting['hasil suara'][0] == 1)
    <?php $warnacok = ['', 'dark', 'info', 'warning', 'primary', 'danger'] ?>
    <section id="hasil" class="row pt-4 mb-2 justify-content-center">
        @foreach ($datacalon as $item)
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-{{$warnacok[$item->no_urut]}} elevation-1"><i class="fas fa-user-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasangan Nomor Urut {{$item->no_urut}}</span>
                    <span class="info-box-number">{{$item->ketua}}</span>
                    <span class="info-box-number">{{$item->wakil}}</span>
                </div>
                <div class="info-box-footer">
                    Persentase Suara :
                    {{$datasuarapersonal[$item->no_urut] == 0 ? 0 : round((
                    $datasuarapersonal[$item->no_urut]/$suaramasuk), 4) * 100 }}
                    % ({{$datasuarapersonal[$item->no_urut]}} Suara)
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <div class="dropdown-divider"></div>
    @endif --}}
    @if ($setting['cara pilih'][0] == 1)
    <section id="cara" class="pt-5 row justify-content-center">
        <div class="col-6">
            <h1 class="text-center brand-text font-weight-bold mb-3">Cara Memilih</h1>
        </div>
        <div class="col-12 text-center">
            <img class="img-fluid" src="{{asset('/images/tata-cara/tata-cara.jpg')}}">
        </div>
    </section>
    <div class="dropdown-divider"></div>
    @endif
    <section id="tentang" class="row pt-5 justify-content-center">
        <div class="col-12">
            <h1 class="text-center brand-text font-weight-bold mb-3">Tentang</h1>
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img class="mx-auto img-thumbnail" src="{{ asset('/admin/dist/img/kpum.png') }}" alt="">
                        </div>
                        <p>
                            <strong>
                                Komisi Pemilihan Umum Mahasiswa Sekolah Tinggi Teknologi Indonesia Tanjungpinang
                            </strong>
                            merupakan badan yang dibentuk oleh Majelis Permusywaratan Mahasiswa Sekolah Tinggi
                            Teknologi Indonesia Tanjungpinang dalam rangka melakukan pemilihan Presiden dan
                            Wakil Presiden Mahasiswa Sekolah Tinggi Teknologi Indonesia Tanjungpinang
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection