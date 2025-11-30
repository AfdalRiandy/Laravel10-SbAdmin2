@extends('admin.layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengguna</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pengguna</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required onchange="toggleRoleFields()">
                        <option value="" disabled>Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Staff Fields (Kepala Sekolah & Guru Pendamping) -->
                <div id="staff-fields" style="display: none;">
                    <h6 class="font-weight-bold text-primary mt-4 mb-3">Informasi Staff</h6>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip', $user->staffProfile->nip ?? '') }}">
                        @error('nip')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="staff_phone">No. Telepon</label>
                        <input type="text" class="form-control @error('staff_phone') is-invalid @enderror" id="staff_phone" name="staff_phone" value="{{ old('staff_phone', $user->staffProfile->phone ?? '') }}">
                        @error('staff_phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Penjual Fields -->
                <div id="penjual-fields" style="display: none;">
                    <h6 class="font-weight-bold text-primary mt-4 mb-3">Informasi Penjual (Siswa)</h6>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis', $user->penjualProfile->nis ?? '') }}">
                        @error('nis')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas', $user->penjualProfile->kelas ?? '') }}">
                                @error('kelas')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan', $user->penjualProfile->jurusan ?? '') }}">
                                @error('jurusan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penjual_phone">No. Telepon</label>
                        <input type="text" class="form-control @error('penjual_phone') is-invalid @enderror" id="penjual_phone" name="penjual_phone" value="{{ old('penjual_phone', $user->penjualProfile->phone ?? '') }}">
                        @error('penjual_phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="shop_name">Nama Toko</label>
                        <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" name="shop_name" value="{{ old('shop_name', $user->penjualProfile->shop_name ?? '') }}">
                        @error('shop_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleRoleFields() {
        const role = document.getElementById('role').value;
        const staffFields = document.getElementById('staff-fields');
        const penjualFields = document.getElementById('penjual-fields');

        staffFields.style.display = 'none';
        penjualFields.style.display = 'none';

        if (role === 'kepala_sekolah' || role === 'guru_pendamping') {
            staffFields.style.display = 'block';
        } else if (role === 'penjual') {
            penjualFields.style.display = 'block';
        }
    }

    // Run on load to handle old input
    document.addEventListener('DOMContentLoaded', function() {
        toggleRoleFields();
    });
</script>
@endsection