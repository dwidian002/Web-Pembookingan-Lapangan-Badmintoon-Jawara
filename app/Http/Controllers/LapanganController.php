<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function list(){
        $lapangan = Lapangan::all();
        return view('backend.content.lapangan.list',[
            'lapangan' => $lapangan
        ]);
    }


    public function tambah(){
        $lapangan = Lapangan::all();
        return view("backend.content.lapangan.tambah",[
            'lapangan' => $lapangan
        ]);
    }

    public function prosesTambah(Request $request){
        $this->validate($request, [
            'nama_lapangan' => 'required',
        ]);

        $lapangan = new Lapangan();
        $lapangan->nama_lapangan = $request->nama_lapangan;

        try {
            $lapangan->save();
            return redirect(route('lapangan.list'))->with('pesan', ['success', 'Berhasil Tambah data lapangan']);
        } catch (\Exception $e) {
            return redirect(route('lapangan.list'))->with('pesan', ['danger', 'Gagal Tambah data lapangan']);
        }
    }

    public function edit($id){
        $lapangan = Lapangan::findOrFail($id);
        return view('backend.content.lapangan.edit', compact('lapangan'));

    }

    public function prosesEdit(Request $request)
    {
        $this->validate($request, [
            'id_lapangan' => 'required',
            'nama_lapangan' => 'required'
        ]);

        $lapangan = Lapangan::findOrFail($request->id_lapangan);
        $lapangan->nama_lapangan = $request->nama_lapangan;

        try {
            $lapangan->save();
            return redirect(route('lapangan.list'))->with('pesan',['success','Berhasil ubah lapangan']);
        }catch (\Exception $e){
            return redirect(route('lapangan.list'))->with('pesan',['danger','Gagal ubah lapangan']);

        }

    }

    public function hapus($id){
        $lapangan = Lapangan::findOrFail($id);

        try {
            $lapangan->delete();
            return redirect(route('lapangan.list'))->with('pesan',['success','Berhasil hapus lapangan']);
        }catch (\Exception $e){
            return redirect(route('lapangan.list'))->with('pesan',['danger','Gagal hapus lapangan']);

        }

    }
}
