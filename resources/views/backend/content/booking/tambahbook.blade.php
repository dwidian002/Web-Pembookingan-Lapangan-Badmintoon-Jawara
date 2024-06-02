@extends('layout/main')

@section('judul', 'Tambah Pesanan Pembookingan Lapangan')

@section('content')
<div class="container-fluid">
    <h2>Tambah Pesanan</h2>
    <h2>Tanggal: {{$date}}</h2>
    <form id="bookingForm" action="{{route('booking.prosestambah.book')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_customer">Customer:</label>
            <select class="form-control" id="id_customer" name="id_customer" required>
                @foreach ($customer as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_lapangan">Pilih Jadwal:</label> <br />
            @foreach ($bs as $row)
            @if($row->status == 1)
            <input type="checkbox" checked disabled> {{$row->lapangan->nama_lapangan}} : {{$row->session->name}} <br />
            @else
            <input type="checkbox" name="idbs[]" value="{{$row->id}}"> {{$row->lapangan->nama_lapangan}} : {{$row->session->name}} <br />
            @endif
            @endforeach
        </div>
        <input type="hidden" name="date" value="{{$date}}">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">Submit</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" id="closeModalButton" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Silakan konfirmasi pembayaran ke nomor WhatsApp berikut ini: <b>085643194893</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">Tutup</button>
                <a class="btn btn-info" href="https://wa.link/zl5wy6"><i class="fa fa-phone"></i> Konfirmasi</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('bookingForm').submit();
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        window.location.href = "{{ route('booking.detail', ['tgl' => $date, 'pesan' => 'success']) }}";
    });
</script>
@endsection
