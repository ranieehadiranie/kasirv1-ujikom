@extends('admin.template.master')

@section('title')
    KASIR | Edit User
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header py-10 text-white">
            <div class="card-tollbar">
                <h4 class="mb-0">Edit User</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas-requests.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (kosongkan jika tidak diubah):</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>petugas</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                    </select>
                    @error('role')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('petugas-requests.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
