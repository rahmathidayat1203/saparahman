@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Mapel Kelas</h4>

                <form action="{{ route('mapel_kelas.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="nama_kelas">Nama Kelas</label>
                        <select name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" required>
                            <option value="">-- Pilih Nama Kelas --</option>
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}" {{ old('nama_kelas') == $kelasItem->id ? 'selected' : '' }}>
                                    {{ $kelasItem->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="id_master_mapel">Mata Pelajaran</label>
                        <select name="id_master_mapel" class="form-control @error('id_master_mapel') is-invalid @enderror" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($masterMapel as $mapel)
                                <option value="{{ $mapel->id }}" {{ old('id_master_mapel') == $mapel->id ? 'selected' : '' }}>
                                    {{ $mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_master_mapel')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('mapel_kelas.index') }}" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
