
@extends('layout/main')

@section('judul','Edit Pesanan Pembookingan Lapangan')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">Edit Pesanan Pembookingan Lapangan</h1>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('booking.prosesEdit', $booking->id_booking) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_pembooking">Nama Pembooking:</label>
                        <input type="text" class="form-control" id="nama_pembooking" name="nama_pembooking" value="{{ $booking->nama_pembooking }}">
                    </div>
                    <div class="form-group">
                        <label for="lapangan">Lapangan:</label>
                        <select name="id_lapangan" class="form-control @error('id_lapangan') is-invalid  @enderror">
                            @foreach ($lapangan as $row)
                                @php
                                    $selected = $row->id_lapangan == $booking->id_lapangan ? 'selected' : '';
                                @endphp
                                <option value="{{ $row->id_lapangan }}" {{ $selected }}>{{ $row->nama_lapangan }}</option>
                            @endforeach
                        </select>

                        @error('id_lapangan')
                        <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="waktu_booking">Waktu Booking:</label>
                        <input type="date" class="form-control" id="waktu_booking" name="waktu_booking" value="{{ $booking->waktu_booking }}">
                    </div>
                    @method('PUT')

                    <div class="form-group">
                        <label for="jam_booking">Jam Booking:</label>
                        <div>
                            @foreach ($jamBooking as $jam)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input jam-booking" type="checkbox" name="jam_booking[]" id="jam_{{ $loop->index }}" value="{{ $jam }}"
                                        {{ in_array($jam, $booking->jam_booking) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jam_{{ $loop->index }}">
                                        {{ $jam }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="durasi_booking">Durasi Booking (jam):</label>
                        <input type="number" class="form-control" id="durasi_booking" name="durasi_booking" readonly>
                    </div>

                    <input type="hidden" name="id_booking" value="{{$booking->id_booking}}">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('booking.list') }}" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.jam-booking');
            const durasiBooking = document.getElementById('durasi_booking');

            function updateDurasiBooking() {
                const checkedCount = document.querySelectorAll('.jam-booking:checked').length;
                durasiBooking.value = checkedCount;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateDurasiBooking);
            });

            // Initial update in case some checkboxes are pre-checked
            updateDurasiBooking();
        });
    </script>
@endsection
