@extends('layout/main')

@section('judul','Edit Foto Galeri')
@section('content')

<div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Edit Foto Galeri</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('galeri.prosesEdit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul galeri</label>
                        <input type="text" name="judul_foto" value="{{ $galeri->judul_foto }}"
                            class="form-control @error('judul_foto') is-invalid  @enderror">
                        @error('judul_foto')
                            <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto galeri</label>
                        <input type="file" name="foto_galeri"
                            class="form-control @error('foto_galeri') is-invalid  @enderror" accept="image/*"
                            onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('judul_foto')
                            <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                        @enderror
                        <p></p>
                        <img id="tampilFoto"
                            onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg'; "
                            src="{{route('storage', $galeri->foto_galeri)}}" alt="" width="30%">
                    </div>

                    <input type="hidden" name="id_foto" value="{{$galeri->id_foto}}">

                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="{{ route('galeri.list') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection