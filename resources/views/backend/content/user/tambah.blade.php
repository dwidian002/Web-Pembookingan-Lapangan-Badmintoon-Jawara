@extends('layout/main')
@section('judul','Tambah Data Users')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Tambah Data Users</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('user.prosesTambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                    @error('role')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('user.list') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
