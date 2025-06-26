@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Orang Tua</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali isian Anda.</strong>
                    </div>
                @endif

                <form action="{{ route('orangtua.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                        <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror" id="nama_ortu" name="nama_ortu" value="{{ old('nama_ortu') }}" required>
                        @error('nama_ortu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_kk" class="form-label">No KK</label>
                        <input type="text" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" name="no_kk" value="{{ old('no_kk') }}" required>
                        @error('no_kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success me-2">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('orangtua.index') }}" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
