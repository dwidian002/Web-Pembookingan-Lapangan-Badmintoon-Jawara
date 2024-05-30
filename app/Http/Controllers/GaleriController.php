<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function list()
    {
        $galeri = Galeri::all();
        return view("backend.content.galeri.list", [
            'galeri' => $galeri
        ]);
    }

    public function tambah()
    {
        $galeri = Galeri::all();
        return view("backend.content.galeri.tambah", [
            'galeri' => $galeri
        ]);
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'judul_foto' => 'required',
            'foto_galeri' => 'required',
        ]);

        $request->file('foto_galeri')->store('public');
        $foto_galeri = $request->file('foto_galeri')->hashName();

        $galeri = new galeri();
        $galeri->judul_foto = $request->judul_foto;
        $galeri->foto_galeri = $foto_galeri;

        try {
            $galeri->save();
            return redirect(route('galeri.list'))->with('pesan', ['success', 'Berhasil Tambah foto galeri']);
        } catch (\Exception $e) {
            return redirect(route('galeri.list'))->with('pesan', ['danger', 'Gagal Tambah foto galeri']);
        }
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('backend.content.galeri.edit', [
            'galeri' => $galeri
        ]);
    }

    public function prosesEdit(Request $request)
    {
        $this->validate($request, [
            'judul_foto' => 'required',
        ]);

        $galeri = Galeri::findOrFail($request->id_foto);
        $galeri->judul_foto = $request->judul_foto;

        if ($request->hasFile('foto_galeri')) {
            $request->file('foto_galeri')->store('public');
            $foto_galeri = $request->file('foto_galeri')->hashName();
            $galeri->foto_galeri = $foto_galeri;
        }

        try {
            $galeri->save();
            return redirect(route('galeri.list'))->with('pesan', ['success', 'Berhasil Ubah galeri']);
        } catch (\Exception $e) {
            return redirect(route('galeri.list'))->with('pesan', ['danger', 'Gagal Ubah galeri']);
        }
    }


    public function hapus($id)
    {
        $galeri = Galeri::findOrFail($id);

        try {
            $galeri->delete();
            return redirect(route('galeri.list'))->with('pesan', ['success', 'Berhasil Hapus galeri']);
        } catch (\Exception $e) {
            return redirect(route('galeri.list'))->with('pesan', ['danger', 'Gagal Hapus galeri']);
        }
    }
}
