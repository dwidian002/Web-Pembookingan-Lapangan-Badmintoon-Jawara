<?php

namespace App\Http\Controllers;

use App\Models\BookingSession;
use App\Models\Galeri;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooking = BookingSession::where('status', 1)->count();
        $totalLapangan = Lapangan::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalGaleri = Galeri::count();

        $latestPesanan = BookingSession::where('status', 1)->latest()->get()->take(5);
        return view("backend.content.dashboard", compact('totalBooking','totalLapangan','totalPelanggan','totalGaleri','latestPesanan'));
    }
}
