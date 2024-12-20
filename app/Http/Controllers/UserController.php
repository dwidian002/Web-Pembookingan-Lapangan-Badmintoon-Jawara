<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.content.user.list', compact('users'));
    }

    public function tambah()
    {
        return view('backend.content.user.tambah');
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        try {
            $user->save();
            return redirect()->route('user.list')->with('pesan', ['success', 'Berhasil Tambah Data user']);
        } catch (\Exception $e) {
            return redirect()->route('user.list')->with('pesan', ['danger', 'Gagal Tambah Data user']);
        }
    }

    public function ubah($id)
    {
        $user = User::findOrFail($id);
        return view('backend.content.user.edit', compact('user'));
    }

    public function prosesUbah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'nullable|string',
            'role' => 'required',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('user.list')->with('pesan', ['success', 'Berhasil Update Data user']);
        } catch (\Exception $e) {
            return redirect()->route('user.list')->with('pesan', ['danger', 'Gagal Update Data user']);
        }
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('user.list'))->with('pesan',['success','Berhasil hapus user']);
        }catch (\Exception $e){
            return redirect(route('user.list'))->with('pesan',['danger','Gagal hapus user']);

        }

    }
}
