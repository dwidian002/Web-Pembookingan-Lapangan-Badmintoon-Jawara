@extends('layout/main')

@section('judul', 'Tambah Pesanan Pembookingan Lapangan')

@section('content')
    <div class="container-fluid">
        <h2>Tambah Pesanan</h2>
        <h2>Tanggal: {{$date}}</h2>
        <form id="bookingForm" action="{{route('booking.prosestambah.book')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_lapangan">Customer:</label>
                <select class="form-control" id="id_customer" name="id_customer" required>
                    @foreach ($customer as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_lapangan">Pilih Jadwal:</label> <br/>
                @foreach ($bs as $row)

                    @if($row->status == 1)
                        <input type="checkbox" checked disabled> {{$row->lapangan->nama_lapangan}} : {{$row->session->name}} <br/>
                    @else
                        <input type="checkbox" name="idbs[]" value="{{$row->id}}"> {{$row->lapangan->nama_lapangan}} : {{$row->session->name}} <br/>
                    @endif


                @endforeach
            </div>
            <input type="hidden" name="date" value="{{$date}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
