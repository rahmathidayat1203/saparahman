@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Guru Baru</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa kembali isian Anda.</strong>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('guru.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_guru" class="form-label">Nama Guru</label>
                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror"
                                id="nama_guru" name="nama_guru" value="{{ old('nama_guru') }}" required>
                            @error('nama_guru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_guru" class="form-label">Nomor WhatsApp</label>
                            <input type="number" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa"
                                name="no_wa" value="{{ old('no_wa') }}" required>
                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
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
                            <select class="form-select @error('id_kelas') is-invalid @enderror" id="id_kelas"
                                name="id_kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('id_kelas') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="roles" class="form-label">Role</label>
                            <select name="roles[]" id="roles" class="form-control @error('roles') is-invalid @enderror"
                                multiple="multiple">
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-success me-2">
                            <i class="mdi mdi-content-save"></i> Simpan
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
