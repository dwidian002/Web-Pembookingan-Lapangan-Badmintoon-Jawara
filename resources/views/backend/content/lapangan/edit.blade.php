@extends('layout.main')
@section('judul','Data Lapangan')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Edit Lapangan</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('lapangan.prosesEdit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form label">Nama lapangan</label>
                        <input type="text" name="nama_lapangan" value="{{$lapangan->nama_lapangan}}" class="form-control @error('nama_lapangan') is-invalid @enderror">
                        @error('nama_lapangan')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="id_lapangan" value="{{$lapangan->id_lapangan}}">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{route('lapangan.list') }}" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
