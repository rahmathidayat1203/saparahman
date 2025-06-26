@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Kandungan Mading</h4>

                <form action="{{ route('kandungan-mading.update', $kandunganMading->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Dropdown ID Asas --}}
                    <div class="form-group">
                        <label for="id_asas">Asas</label>
                        <select class="form-control @error('id_asas') is-invalid @enderror" id="id_asas" name="id_asas" required>
                            <option value="">Pilih Asas</option>
                            @foreach ($asass as $asas)
                                <option value="{{ $asas->id }}" {{ old('id_asas', $kandunganMading->id_asas) == $asas->id ? 'selected' : '' }}>
                                    {{ $asas->nama_asas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_asas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Pengampu --}}
                    <div class="form-group">
                        <label for="nama_pengampu">Nama Guru Pengampu</label>
                        <input type="text" class="form-control @error('nama_pengampu') is-invalid @enderror" id="nama_pengampu" name="nama_pengampu"
                            value="{{ old('nama_pengampu', $kandunganMading->nama_pengampu) }}" required>
                        @error('nama_pengampu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul --}}
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                            value="{{ old('judul', $kandunganMading->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- File Upload --}}
                    <div class="form-group">
                        <label for="file">File</label><br>
                        @if ($kandunganMading->file)
                            <a href="{{ asset('storage/' . $kandunganMading->file) }}" target="_blank" class="btn btn-sm btn-outline-info mb-2">
                                <i class="mdi mdi-file-document-outline"></i> Lihat File Saat Ini
                            </a>
                        @endif
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                        @error('file')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Desk / Gambaran --}}
                    <div class="form-group">
                        <label for="desk">Gambaran</label>
                        <textarea class="form-control @error('desk') is-invalid @enderror" id="desk" name="desk" rows="4" required>{{ old('desk', $kandunganMading->desk) }}</textarea>
                        @error('desk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                            <label>Ganti File (optional)</label>
                            <input type="file" name="file"
                                class="file-upload-default @error('file') is-invalid @enderror">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload File Baru">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Format yang diperbolehkan: PDF
                            </small>

                            @if ($kandungan_mading->file)
                                <p class="mt-3">
                                    File saat ini:
                                    <a href="{{ asset('storage/kandungan_mading/' . $kandungan_mading->file) }}" target="_blank">
                                        {{ $peraturan->file }}
                                    </a>
                                </p>
                            @endif
                        </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="mdi mdi-content-save"></i> Update
                        </button>
                        <a href="{{ route('kandungan-mading.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
