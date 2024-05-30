<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->get();
        return view('backend.content.admin.list', compact('admin'));
    }

    public function tambah()
    {
        return view('backend.content.admin.tambah');
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
        $user->role = 'admin';

        try {
            $user->save();
            return redirect()->route('spadmin.list')->with('pesan', ['success', 'Berhasil Tambah Data admin']);
        } catch (\Exception $e) {
            return redirect()->route('spadmin.list')->with('pesan', ['danger', 'Gagal Tambah Data admin']);
        }
    }

    public function ubah($id)
    {
        $admin = User::findOrFail($id);
        return view('backend.content.admin.edit', compact('admin'));
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
            return redirect()->route('spadmin.list')->with('pesan', ['success', 'Berhasil Update Data admin']);
        } catch (\Exception $e) {
            return redirect()->route('spadmin.list')->with('pesan', ['danger', 'Gagal Update Data admin']);
        }
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('spadmin.list'))->with('pesan',['success','Berhasil hapus admin']);
        }catch (\Exception $e){
            return redirect(route('spadmin.list'))->with('pesan',['danger','Gagal hapus admin']);

        }

    }
}
