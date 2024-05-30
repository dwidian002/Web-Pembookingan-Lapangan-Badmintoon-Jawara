@extends('layout.main')
@section('judul','Data Lapangan')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List lapangan</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('lapangan.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>

        @if (session()->has('pesan'))
        <div class="alert alert-{{session()->get('pesan')[0]}}">
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
                                <th>Nama lapangan</th>
                                <th>Aksi</th>
                                </tr>
                        </thead>
                        <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($lapangan as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_lapangan}}</td>
                                <td>
                                <a href="{{route('lapangan.edit',$row->id_lapangan)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{route('lapangan.hapus',$row->id_lapangan)}}" onclick="return confirm('Anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection