<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = User::where('role', 'pelanggan')->get();
        return view('backend.content.pelanggan.list', compact('pelanggan'));
    }

    public function tambah()
    {
        return view('backend.content.pelanggan.tambah');
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'pelanggan';

        try {
            $user->save();
            return redirect()->route('pelanggan.list')->with('pesan', ['success', 'Berhasil Tambah Data Pelanggan']);
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.list')->with('pesan', ['danger', 'Gagal Tambah Data Pelanggan']);
        }
    }

    public function ubah($id)
    {
        $pelanggan = User::findOrFail($id);
        return view('backend.content.pelanggan.edit', compact('pelanggan'));
    }

    public function prosesUbah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'nullable|string',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('pelanggan.list')->with('pesan', ['success', 'Berhasil Update Data Pelanggan']);
        } catch (\Exception $e) {
            return redirect()->route('pelanggan.list')->with('pesan', ['danger', 'Gagal Update Data Pelanggan']);
        }
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('pelanggan.list'))->with('pesan',['success','Berhasil hapus pelanggan']);
        }catch (\Exception $e){
            return redirect(route('pelanggan.list'))->with('pesan',['danger','Gagal hapus pelanggan']);

        }

    }
}
