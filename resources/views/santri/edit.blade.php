@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Santri</h4>

                    {{-- Tampilkan pesan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi Kesalahan!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form update santri --}}
                    <form action="{{ route('santri.update', $santri->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_santri" class="form-label">Nama Santri</label>
                            <input type="text" name="nama_santri"
                                class="form-control @error('nama_santri') is-invalid @enderror"
                                value="{{ old('nama_santri', $santri->nama_santri) }}" required>
                            @error('nama_santri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror"
                                value="{{ old('nisn', $santri->nisn) }}" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                                value="{{ old('nis', $santri->nis) }}" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nsm" class="form-label">NSM</label>
                            <input type="text" name="nsm" class="form-control @error('nsm') is-invalid @enderror"
                                value="{{ old('nsm', $santri->nsm) }}" required>
                            @error('nsm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="npsm" class="form-label">NPSM</label>
                            <input type="text" name="npsm" class="form-control @error('npsm') is-invalid @enderror"
                                value="{{ old('npsm', $santri->npsm) }}" required>
                            @error('npsm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select name="id_kelas" id="id_kelas"
                                class="form-select rounded-pill py-2 px-3 @error('id_kelas') is-invalid @enderror" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $k->id == old('id_kelas', $santri->id_kelas) ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }} - {{ $k->tingkatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender"
                                class="form-select rounded-pill py-2 px-3 @error('gender') is-invalid @enderror" required>
                                <option value="">-- Pilih Gender --</option>
                                <option value="santriwan"
                                    {{ old('gender', $santri->gender) == 'santriwan' ? 'selected' : '' }}>
                                    Santriwan
                                </option>
                                <option value="santriwati"
                                    {{ old('gender', $santri->gender) == 'santriwati' ? 'selected' : '' }}>
                                    Santriwati
                                </option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-success me-2">
                            <i class="mdi mdi-content-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('santri.index') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i> Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
