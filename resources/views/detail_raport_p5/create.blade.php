@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Detail Raport P5</h4>
                    <p class="card-description">
                        Formulir untuk menambah detail raport proyek P5
                    </p>

                    <form class="forms-sample" action="{{ route('detail-raport-p5.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_raport">Raport</label>
                            <select name="id_raport" class="form-control @error('id_raport') is-invalid @enderror" required>
                                <option value="">-- Pilih Raport --</option>
                                @foreach ($raports as $raport)
                                    <option value="{{ $raport->id }}" {{ old('id_raport') == $raport->id ? 'selected' : '' }}>
                                        Semester {{ $raport->semester }} - {{ $raport->santri->nama_santri ?? 'Santri tidak ditemukan' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_raport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" required>
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPG, PNG (Max: 2MB)</small>
                        </div>

                        <div class="form-group">
                            <label for="desk">Deskripsi</label>
                            <textarea name="desk" class="form-control @error('desk') is-invalid @enderror"
                                      rows="4" required>{{ old('desk') }}</textarea>
                            @error('desk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Simpan
                        </button>
                        <a href="{{ route('detail-raport-p5.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
