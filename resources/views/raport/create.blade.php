@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Raport</h4>

                <form action="{{ route('raport.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_santri" class="form-label">Santri</label>
                        <select class="form-control" id="id_santri" name="id_santri" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santris as $santri)
                                <option value="{{ $santri->id }}" {{ old('id_santri') == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_santri')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_guru" class="form-label">Guru</label>
                        <select class="form-control" id="id_guru" name="id_guru" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ old('id_guru') == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-control" id="id_kelas" name="id_kelas" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}" {{ old('id_kelas') == $kelasItem->id ? 'selected' : '' }}>
                                    {{ $kelasItem->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kelas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-control" id="semester" name="semester" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                            <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                        </select>
                        @error('semester')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('raport.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
