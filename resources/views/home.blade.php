@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    @if (session('pemberitahuan'))
    <div class="alert bg-{{session('warna')}} alert-dismissable text-center mt-3" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('pemberitahuan')}}
    </div>
    @endif
    <div class="row mt-3">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Super Administrator</span>
                    <span class="info-box-number">
                        {{ $superadmin }} Orang
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-lock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Administrator</span>
                    <span class="info-box-number">
                        {{ $admin }} Orang
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-vote-yea"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Suara Masuk</span>
                    <span class="info-box-number">
                        {{ $jumlahsuara }} Suara
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pemilih</span>
                    <span class="info-box-number">
                        {{ $jumlahpemilih }} Pemilih
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Calon Peserta</span>
                    <span class="info-box-number">
                        {{ $jumlahcalon }} Pasangan Calon
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection