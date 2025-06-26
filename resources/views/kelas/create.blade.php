@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Kelas</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan pada input:<br>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="tingkatan">Tingkatan</label>
                        <input type="text" class="form-control rounded-pill py-2 px-3 @error('tingkatan') is-invalid @enderror" 
                               id="tingkatan" name="tingkatan" value="{{ old('tingkatan') }}">
                        @error('tingkatan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tingkat_kelas">Tingkat Kelas</label>
                        <input type="text" class="form-control rounded-pill py-2 px-3 @error('tingkat_kelas') is-invalid @enderror" 
                               id="tingkat_kelas" name="tingkat_kelas" value="{{ old('tingkat_kelas') }}">
                        @error('tingkat_kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" class="form-control rounded-pill py-2 px-3 @error('nama_kelas') is-invalid @enderror" 
                               id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}">
                        @error('nama_kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
