@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @include('layouts.adminnav')
        @if (session('pemberitahuan'))
            <div class="alert bg-{{ session('warna') }} alert-dismissable text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('pemberitahuan') }}
            </div>
        @endif
        <div class="row my-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="font-weight-bold text-center">Pengaturan Pemilihan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="font-weight-bold text-center">
                                    Jadwal Pemilihan
                                </h4>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="tanggalbuka">Tanggal Mulai Pemilihan</label>
                                <form action="{{ route('updatewaktu') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input type="datetime-local" class="form-control" name="tanggal" id="tanggalbuka"
                                            value="{{ date('Y-m-d\TH:i', strtotime($waktu['Buka'][0])) }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" name="type"
                                                value="Buka">Update Tanggal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12">
                                <label for="tanggaltutup">Tanggal Selesai Pemilihan</label>
                                <form action="{{ route('updatewaktu') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input type="datetime-local" class="form-control" name="tanggal" id="tanggaltutup"
                                            value="{{ date('Y-m-d\TH:i', strtotime($waktu['Tutup'][0])) }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" name="type"
                                                value="Tutup">Update Tanggal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (Auth::user()->level == 0)
                            @if (date('Y-m-d') > date('Y-m-d', strtotime($waktu['Tutup'][0])))
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <a href="{{ route('hapuspemilihall') }}"
                                            class="btn btn-sm btn-danger btn-block font-weight-bold"
                                            onclick="return confirm('Yakin ingin menghapus semua data pemilih?')">
                                            Hapus Semua Data Pemilih
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-danger btn-block font-weight-bold" data-toggle="modal"
                                            data-target="#modalreset">
                                            Reset Aplikasi
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="font-weight-bold text-center">Pengaturan Profil Admin</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updatedata') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <label for="name">Nama</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ Auth::user()->name }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="username">Username</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="username" id="username"
                                            value="{{ Auth::user()->username }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="password">Ubah Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Isi untuk mengubah password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="submit" value="Simpan" class="btn btn-dark btn-block">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="font-weight-bold text-center">Pengaturan Halaman Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if (Auth::user()->level == 0)
                                    <div class="form-group my-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="hasilsuara"
                                                onclick="updatesetting(this.checked, this.id)"
                                                {{ $setting['hasilsuara'][0] == 1 ? 'checked' : null }}>
                                            <label class="custom-control-label" for="hasilsuara">Status Hasil
                                                Pemilihan</label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group my-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="waktupemilihan"
                                            onclick="updatesetting(this.checked, this.id)"
                                            {{ $setting['waktupemilihan'][0] == 1 ? 'checked' : null }}>
                                        <label class="custom-control-label" for="waktupemilihan">Status Waktu
                                            Pemilihan</label>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="carousel"
                                            onclick="updatesetting(this.checked, this.id)"
                                            {{ $setting['carousel'][0] == 1 ? 'checked' : null }}>
                                        <label class="custom-control-label" for="carousel">Status Carousel</label>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-12">
                                            <label for="gambarcarousel">Tambah Gambar Carousel</label>
                                            <form action="{{ route('tambahgambar') }}" method="post"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <input type="file" class="form-control" name="gambarcarousel"
                                                        id="gambarcarousel">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="submit" name="type"
                                                            value="carousel">Upload Gambar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <small class="text-danger">
                                                *Upload gambar untuk carousel pada halaman beranda.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row my-3 justify-content-center">
                                        @if ($jumlahcarousel > 0)
                                            @for ($i = 0; $i < $jumlahcarousel; $i++)
                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img class="mb-3 img-thumbnail"
                                                                src="{{ asset('images/carousel/' . $filecarousel[$i]) }}">
                                                            <form action="{{ route('hapusgambar') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="target"
                                                                    value="{{ $i }}">
                                                                <button class="btn btn-sm btn-danger ml-2 mb-3" name="type"
                                                                    value="carousel" type="submit"
                                                                    onclick="return confirm('Hapus gambar ini?')">Hapus
                                                                    Gambar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        @else
                                            <div class="col-12 border p-2 m-2">
                                                <h1 class="text-center">Data gambar carousel tidak tersedia</h1>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="carapilih"
                                            onclick="updatesetting(this.checked, this.id)"
                                            {{ $setting['carapilih'][0] == 1 ? 'checked' : null }}>
                                        <label class="custom-control-label" for="carapilih">Status Cara
                                            Pemilihan</label>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-12">
                                            <label for="gambarcarapilih">Tambah Gambar / Video Cara Pemilihan</label>
                                            <form action="{{ route('tambahgambar') }}" method="post"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <input type="file" class="form-control" name="gambarcarapilih"
                                                        id="gambarcarapilih">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="submit" name="type"
                                                            value="carapilih">Upload Gambar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <small class="text-danger">
                                                *Upload gambar / video untuk cara pemilihan pada halaman beranda.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row my-3 justify-content-center">
                                        @if ($jumlahcarapilih > 0)
                                            @for ($i = 0; $i < $jumlahcarapilih; $i++)
                                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            @php
                                                                $mime = mime_content_type(public_path('images/carapilih/' . $filecarapilih[$i]));
                                                            @endphp
                                                            @if (strstr($mime, 'video/'))
                                                                <div class="embed-responsive embed-responsive-16by9 mb-3">
                                                                    <video class="embed-responsive-item" controls
                                                                        controlsList="nodownload">
                                                                        <source
                                                                            src="{{ asset('/images/carapilih/' . $filecarapilih[$i]) }}">
                                                                    </video>
                                                                </div>
                                                            @elseif(strstr($mime, 'image/'))
                                                                <img class="img-thumbnail mb-3"
                                                                    src="{{ asset('/images/carapilih/' . $filecarapilih[$i]) }}">
                                                            @endif
                                                            {{-- <img class="mb-3 img-thumbnail"
                                                                src="{{ asset('images/carapilih/' . $filecarapilih[$i]) }}"> --}}
                                                            <form action="{{ route('hapusgambar') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="target"
                                                                    value="{{ $i }}">
                                                                <button class="btn btn-sm btn-danger ml-2 mb-3" name="type"
                                                                    value="carapilih" type="submit"
                                                                    onclick="return confirm('Hapus gambar ini?')">
                                                                    Hapus Gambar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor

                                        @else
                                            <div class="col-12 border p-2 m-2">
                                                <h1 class="text-center">Data gambar cara pemilihan tidak tersedia</h1>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->level == 0)
        @if (date('Y-m-d') > date('Y-m-d', strtotime($waktu['Tutup'][0])))
            <div class="modal fade" id="modalreset">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Aplikasi?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('resetapp') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>
                                    Mereset aplikasi menyebabkan penghapusan data pemilih, data calon, dan data
                                    administrator dengan menyisakan satu Super Administrator dengan username dan password
                                    default. Masukkan password anda untuk melanjutkan!
                                </p>
                                <input type="password" name="password" class="form-control" placeholder="Input Password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Lanjutkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection

@section('customjs')
    <script>
        function updatesetting(value, id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('updatepengaturan') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'value': value,
                    'id': id
                },
                success: function(datax) {
                    if ($datax = 1) {
                        alert('Berhasil aktivasi ' + id + ' pada halaman dashboard!');
                    } else {
                        alert('Berhasil non-aktivasi ' + id + ' pada halaman dashboard!');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                },
            });
        }
    </script>
@endsection
