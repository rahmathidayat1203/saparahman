@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Admin</h4>
                    <p class="card-description">Formulir untuk menambahkan data admin</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">Periksa kembali isian Anda.</div>
                    @endif

                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf

                        <div class="form-group">
                            <label for="nama_admin">Nama</label>
                            <input type="text" name="nama_admin"
                                class="form-control @error('nama_admin') is-invalid @enderror"
                                value="{{ old('nama_admin') }}">
                            @error('nama_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_wa">Nomor WhatsApp</label>
                            <input type="number" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror"
                                value="{{ old('no_wa') }}">
                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Profil</label>
                            <input type="file" name="foto" accept="image/*"
                                class="form-control-file @error('foto') is-invalid @enderror">
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="roles">Role</label>
                            <select name="roles[]" id="roles" class="form-control @error('roles') is-invalid @enderror"
                                multiple>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ in_array($value, old('roles', [])) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
