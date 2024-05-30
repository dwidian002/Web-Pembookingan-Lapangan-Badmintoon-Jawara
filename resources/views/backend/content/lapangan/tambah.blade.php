@extends('layout.main')
@section('judul','Data Lapangan')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Tambah Data Lapangan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <form method="POST" action="{{ route('lapangan.prosesTambah')}}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Lapangan</label>
                                    <input type="text"
                                        class="form-control @error('nama_lapangan') is-invalid @enderror"
                                        value="{{old('nama_lapangan')}}"
                                        name="nama_lapangan">
                                        @error('nama_lapangan')
                                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <a href="{{ route('lapangan.list') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
