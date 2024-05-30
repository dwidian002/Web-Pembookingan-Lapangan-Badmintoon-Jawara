@extends('layout/main')

@section('judul','List Pesanan Pembookingan Lapangan')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Pesanan Pembookingan Lapangan</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('booking.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Generate Jadwal Per Hari</a>
            </div>
        </div>
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session()->get('pesan')[0] }}">
                {{ session()->get('pesan')[1] }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($bs as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->date }}</td>
                                <td>
                                    <a href="{{route('booking.detail',$row->date)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Lihat</a>
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
