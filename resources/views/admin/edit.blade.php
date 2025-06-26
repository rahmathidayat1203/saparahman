@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Admin</h4>
                <p class="card-description">Ubah informasi akun admin sesuai kebutuhan</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali isian Anda.</strong>
                    </div>
                @endif

                <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_admin">Nama Admin</label>
                        <input type="text" name="nama_admin" id="nama_admin"
                            class="form-control @error('nama_admin') is-invalid @enderror"
                            value="{{ old('nama_admin', $admin->nama_admin) }}" required>
                        @error('nama_admin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_wa">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" id="no_wa"
                            class="form-control @error('no_wa') is-invalid @enderror"
                            value="{{ old('no_wa', $users->no_wa ?? '') }}" required>
                        @error('no_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $admin->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $admin->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password <small class="text-muted">(biarkan kosong jika tidak diubah)</small></label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password baru jika ingin mengubah">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Ulangi password">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Profil</label><br>
                        @if ($admin->foto)
                            <img src="{{ asset('storage/' . $admin->foto) }}" width="100" class="rounded mb-2">
                        @endif
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto"
                            name="foto" accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="roles">Role</label>
                        <select name="roles" id="roles" class="form-control @error('roles') is-invalid @enderror">
                            <option value="">Pilih Role</option>
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('roles', $users?->roles?->first()?->name ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success me-2">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>
                    <a href="{{ route('admin.index') }}" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
