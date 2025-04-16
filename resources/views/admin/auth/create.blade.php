@extends('admin.template.master')

@section('title')
    KASIR | Create
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header py-10 text-white">
            <div class="card-tollbar">

                <h4 class="mb-0">Tambah User</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas-requests.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="petugas">petugas</option>
                    </select>
                    @error('role')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection