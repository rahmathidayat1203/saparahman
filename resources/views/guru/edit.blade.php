@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Guru</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa kembali isian Anda.</strong>
                        </div>
                    @endif

                    <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_guru" class="form-label">Nama Guru</label>
                            <input type="text" name="nama_guru" id="nama_guru"
                                class="form-control @error('nama_guru') is-invalid @enderror"
                                value="{{ old('nama_guru', $guru->nama_guru) }}" required>
                            @error('nama_guru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_guru" class="form-label">Nomor WhatsApp</label>
                            <input type="number" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa"
                                name="no_wa" value="{{ old('no_wa', $users->no_wa) }}" required>
                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username', $guru->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $guru->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password"
                                placeholder="Confirm Password"
                                class="form-control @error('confirm-password') is-invalid @enderror">
                            @error('confirm-password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select name="id_kelas" id="id_kelas"
                                class="form-select @error('id_kelas') is-invalid @enderror" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ old('id_kelas', $guru->id_kelas) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label><br>
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" width="100" class="rounded mb-2">
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="roles" class="form-label">Role</label>
                            <select name="roles[]" id="roles" class="form-control @error('roles') is-invalid @enderror"
                                multiple="multiple">
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

                        <button type="submit" class="btn btn-success me-2">
                            <i class="mdi mdi-content-save"></i> Update
                        </button>
                        <a href="{{ route('guru.index') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
