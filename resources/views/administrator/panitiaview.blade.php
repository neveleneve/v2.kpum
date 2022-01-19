@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('layouts.adminnav')
    <div class="row my-3">
        <div class="col-lg-1 col-md-4 col-sm-12">
            <a href="{{ route('administrator') }}" class="btn btn-sm btn-danger btn-block">
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
                <div class="card-header">
                    <h3 class="font-weight-bold text-center">Lihat Data Administrator</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateadministrator') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$data[0]['id']}}">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control mb-3" value="{{$data[0]['name']}}">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" id="username" name="username" class="form-control mb-3"
                            value="{{$data[0]['username']}}">
                        <input type="hidden" id="usernamelama" name="usernamelama" value="{{$data[0]['username']}}">
                        <label for="status">Status Aktif</label>
                        <select name="status" id="status" class="form-control mb-3">
                            <option value="0" {{$data[0]['status']==0 ? 'selected' : null}}>Aktif</option>
                            <option value="1" {{$data[0]['status']==1 ? 'selected' : null}}>Tidak Aktif</option>
                        </select>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-sm btn-dark btn-block font-weight-bold" type="submit">Perbarui
                                    Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection