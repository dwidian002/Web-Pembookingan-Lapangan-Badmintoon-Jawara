@extends('layout/main')

@section('judul','List Foto Galeri')

@section('content')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Gambar Galeri</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('galeri.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>
        @if(session()->has('pesan'))
            <div class="alert-{{session()->get('pesan')[0]}}">
                {{session()->get('pesan')[1]}}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Label Foto</th>
                                 <th>Foto</th>     
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                         @php
                         $no = 1;
                         @endphp
                         @foreach($galeri as $galeri)
                             <tr>
                                 <td>{{$no++}}</td>
                                 <td>{{$galeri->judul_foto}}</td>
                                 <td><img src="{{route('storage',$galeri->foto_galeri)}}" width="200px" height="200px"></td>
                                 <td>
                                     <a href="{{route('galeri.edit',$galeri->id_foto)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Ubah</a>
                                     <a href="{{route('galeri.hapus',$galeri->id_foto)}}" onclick="return confirm('Anda Yakin ?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                 </td>
                             </tr>
                         @endforeach
                         </tbody>
                     </table>
            </div>
        </div>
    </div>
@endsection
