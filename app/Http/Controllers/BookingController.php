<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Session;
use App\Models\BookingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{

    public function generate(Request $request)
    {
        #cek apakah telah di generate sebelumnya
        $check = BookingSession::where('date', '=', $request->date)->first();
        if ($check === null) {
            $lapangan = Lapangan::all();
            $session = Session::all();

            foreach ($lapangan as $l) {
                foreach ($session as $s) {
                    $bs = new BookingSession();
                    $bs->date = $request->date;
                    $bs->id_lap = $l->id_lapangan;
                    $bs->id_session = $s->id;
                    $bs->status = 0;
                    $bs->save();
                }
            }

            return redirect()->route('booking.tambah')->with('pesan', ['success', 'Berhasil generate']);
        } else {
            return redirect()->route('booking.tambah')->with('pesan', ['danger', 'Telah di generate']);
        }
    }

    public function list()
    {
        $bs = BookingSession::select('date')->groupBy('date')->get();
        return view('backend.content.booking.list', compact('bs'));
    }

    public function detail($date)
    {
        $bs = BookingSession::with(['session', 'lapangan', 'user'])->where('date', '=', $date)->get();
        return view('backend.content.booking.detail', compact('bs', 'date'));
    }



    public function tambah()
    {

        $lapangans = Lapangan::all();
        return view('backend.content.booking.tambah', compact('lapangans'));
    }

    public function tambahbook($date)
    {
        $customer = User::where('role', '=', 'pelanggan')->get();
        $bs = BookingSession::with(['session', 'lapangan'])->where('date', '=', $date)->get();
        return view('backend.content.booking.tambahbook', compact('customer', 'date', 'bs'));
    }

    public function prosestambahbook(Request $request)
    {
        $id_customer = $request->id_customer;
        $date = $request->date;
        $idbs = $request->idbs;

        foreach ($idbs as $row) {
            $bs = BookingSession::findOrFail($row);
            $bs->id_customer = $id_customer;
            $bs->status = 1;
            $bs->save();
        }

        return redirect()->route('booking.detail', $date)->with('pesan', ['success', 'Berhasil menambah data booking']);
    }

    public function batalkan($idbs)
    {
        $bs = BookingSession::findOrFail($idbs);
        $bs->id_customer = null;
        $bs->status = 0;
        $bs->status_bayar = 0;
        $bs->save();
        return redirect()->route('booking.detail', $bs->date)->with('pesan', ['success', 'Berhasil batalkan data booking']);
    }

    //    public function tambah()
    //    {
    ////        $pelanggans = Pelanggan::all();
    //        $lapangans = Lapangan::all();
    //        $Id_pel = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 8)), 0, 8);
    //        $jamBooking = [
    //            '07.00-08.00 WIB', '08.00-09.00 WIB', '09.00-10.00 WIB', '10.00-11.00 WIB',
    //            '11.00-12.00 WIB', '12.00-13.00 WIB', '13.00-14.00 WIB', '14.00-15.00 WIB',
    //            '15.00-16.00 WIB', '16.00-17.00 WIB', '17.00-18.00 WIB', '18.00-19.00 WIB',
    //            '20.00-21.00 WIB', '21.00-22.00 WIB', '22.00-23.00 WIB'
    //        ];
    //        // Get all bookings
    //        $bookings = Booking::all();
    //
    //        // Generate a list of booked slots
    //        $bookedSlots = [];
    //        foreach ($bookings as $booking) {
    //            $bookedSlots[$booking->id_lapangan][$booking->waktu_booking][] = $booking->jam_booking;
    //        }
    //
    //        return view('backend.content.booking.tambah', compact(/*'pelanggans',*/ 'Id_pel', 'lapangans', 'jamBooking', 'bookedSlots'));
    //    }



    public function prosesTambah(Request $request)
    {
        try {
            $request->validate([
                'nama_pembooking' => 'required|string|max:255',
                'id_lapangan' => 'required|integer',
                'waktu_booking' => 'required|date',
                'jam_booking' => 'required|array',
            ]);

            $durasi_booking = count($request->jam_booking);

            $booking = new Booking;
            $booking->nama_pembooking = $request->nama_pembooking;
            $booking->id_lapangan = $request->id_lapangan;
            $booking->waktu_booking = $request->waktu_booking;
            $booking->jam_booking = implode(',', $request->jam_booking);
            $booking->durasi_booking = $durasi_booking;
            $booking->iduser = Auth::guard('user')->id(); // Tambahkan baris ini
            $booking->save();

            return redirect()->route('booking.list')->with('pesan', ['success', 'Berhasil menambah data booking']);
        } catch (\Exception $e) {
            Log::error('Error saat menambah booking: ' . $e->getMessage());
            return redirect()->route('booking.list')->with('pesan', ['danger', 'Gagal menambah data booking: ' . $e->getMessage()]);
        }
    }





    public function checkBookingAvailability(Request $request)
    {
        $lapangan_id = $request->input('id_lapangan');
        $waktu_booking = $request->input('waktu_booking');

        // Mendapatkan jam booking yang sudah ada untuk lapangan dan tanggal tertentu
        $bookedSlots = Booking::where('id_lapangan', $lapangan_id)
            ->whereDate('waktu_booking', $waktu_booking)
            ->pluck('jam_booking')
            ->toArray();

        return response()->json($bookedSlots);
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $lapangan = Lapangan::all();
        $jamBooking = [
            '07.00-08.00 WIB', '08.00-09.00 WIB', '09.00-10.00 WIB', '10.00-11.00 WIB',
            '11.00-12.00 WIB', '12.00-13.00 WIB', '13.00-14.00 WIB', '14.00-15.00 WIB',
            '15.00-16.00 WIB', '16.00-17.00 WIB', '17.00-18.00 WIB', '18.00-19.00 WIB',
            '20.00-21.00 WIB', '21.00-22.00 WIB', '22.00-23.00 WIB'
        ];

        // Mengonversi string jam_booking menjadi array
        $booking->jam_booking = explode(',', $booking->jam_booking);

        return view('backend.content.booking.edit', compact('booking', 'lapangan', 'jamBooking'));
    }




    public function prosesEdit(Request $request)
    {
        $this->validate($request, [
            'nama_pembooking' => 'required',
            'id_lapangan' => 'required',
            'waktu_booking' => 'required|date',
            'jam_booking' => 'required|array',
            'durasi_booking' => 'required|integer|min:1'
        ]);

        $booking = Booking::findOrFail($request->id_booking);

        $booking->nama_pembooking = $request->nama_pembooking;
        $booking->id_lapangan = $request->id_lapangan;
        $booking->waktu_booking = $request->waktu_booking;
        $booking->jam_booking = implode(',', $request->jam_booking);
        $booking->durasi_booking = $request->durasi_booking;
        $booking->iduser = Auth::guard('user')->id(); // Tambahkan baris ini

        try {
            $booking->save();
            return redirect(route('booking.list'))->with('pesan', ['success', 'Berhasil ubah data booking']);
        } catch (\Exception $e) {
            return redirect(route('booking.list'))->with('pesan', ['danger', 'Gagal ubah data booking']);
        }
    }


    public function approve(Request $request, $idbs)
    {
        $bookingSession = BookingSession::find($idbs);
        if ($bookingSession->status == 1 && $bookingSession->status_bayar == 0) {
            $bookingSession->status_bayar = 1;
            $bookingSession->save();

            return redirect()->back()->with('pesan', ['success', 'Booking berhasil diapprove.']);
        } else {
            return redirect()->back()->with('pesan', ['danger', 'Booking tidak bisa diapprove.']);
        }
    }


    public function hapus($id)
    {
        $booking = Booking::findOrFail($id);

        try {
            $booking->delete();
            return redirect(route('booking.list'))->with('pesan', ['success', 'Berhasil Hapus data booking']);
        } catch (\Exception $e) {
            return redirect(route('booking.list'))->with('pesan', ['danger', 'Gagal Hapus data booking']);
        }
    }
}
