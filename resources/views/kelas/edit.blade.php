@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Kelas</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Ups!</strong> Ada masalah dengan inputanmu:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="tingkatan" class="form-label">Tingkatan</label>
                        <input type="text" name="tingkatan" id="tingkatan" 
                               value="{{ old('tingkatan', $kelas->tingkatan) }}" 
                               class="form-control rounded-pill py-2 px-3 @error('tingkatan') is-invalid @enderror" required>
                        @error('tingkatan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tingkat_kelas" class="form-label">Tingkat Kelas</label>
                        <input type="text" name="tingkat_kelas" id="tingkat_kelas" 
                               value="{{ old('tingkat_kelas', $kelas->tingkat_kelas) }}" 
                               class="form-control rounded-pill py-2 px-3 @error('tingkat_kelas') is-invalid @enderror" required>
                        @error('tingkat_kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" 
                               value="{{ old('nama_kelas', $kelas->nama_kelas) }}" 
                               class="form-control rounded-pill py-2 px-3 @error('nama_kelas') is-invalid @enderror" required>
                        @error('nama_kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success me-2">
                        <i class="mdi mdi-check"></i> Update
                    </button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
