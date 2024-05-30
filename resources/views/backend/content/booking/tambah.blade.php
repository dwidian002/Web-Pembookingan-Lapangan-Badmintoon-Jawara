@extends('layout/main')

@section('judul', 'Tambah Pesanan Pembookingan Lapangan')

@section('content')
    <div class="container-fluid">
        <h2>Generate Jadwal Per Hari</h2>
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session()->get('pesan')[0] }}">
                {{ session()->get('pesan')[1] }}
            </div>
        @endif
        <form id="bookingForm" action="{{ route('booking.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="waktu_booking">Tanggal:</label>
                <input type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
