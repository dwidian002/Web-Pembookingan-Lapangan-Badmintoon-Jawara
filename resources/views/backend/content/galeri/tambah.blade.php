@extends('layout/main')
@section('judul','Tambah Foto Lapangan')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Tambah Foto Galeri</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('galeri.prosesTambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form label">Label Foto</label>
                    <input type="text" name="judul_foto" value="{{old('judul_foto')}}" class="form-control @error('judul_foto') is-invalid @enderror">
                    @error('judul_foto')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form label">Foto</label>
                    <input type="file" name="foto_galeri" class="form-control @error('foto_galeri') is-invalid @enderror"
                           accept="image/*" onchange="tampilkanPreview(this,'tampilGambar')">
                    @error('foto_galeri')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                    <p></p>
                    <img id="tampilGambar" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg';" src="" alt="" width="30%">
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('galeri.list') }}" class="btn btn-success">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection