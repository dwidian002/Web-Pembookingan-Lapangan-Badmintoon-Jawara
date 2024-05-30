@extends('layout/main')

@section('judul','Edit Data Pelanggan')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Edit Data Pelanggan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pelanggan.prosesUbah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" name="name" value="{{ $pelanggan->name }}" class="form-control @error('name') is-invalid  @enderror">
                    @error('name')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $pelanggan->email }}" class="form-control @error('email') is-invalid  @enderror">
                    @error('email')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (biarkan kosong jika tidak ingin mengubah):</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" name="id" value="{{$pelanggan->id}}">

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('pelanggan.list') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection