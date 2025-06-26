@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Tambah Mading</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan saat input:<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="forms-sample" action="{{ route('mading.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="id_kategori_mading">Kategori Mading</label>
                        <select class="form-control @error('id_kategori_mading') is-invalid @enderror" id="id_kategori_mading" name="id_kategori_mading" required>
                            <option value="">Pilih Kategori Mading</option>
                            @foreach ($kategoriMadings as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('id_kategori_mading') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_mading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_asas">Asas</label>
                        <select class="form-control @error('id_asas') is-invalid @enderror" id="id_asas" name="id_asas" required>
                            <option value="">Pilih Asas</option>
                            @foreach ($asass as $asas)
                                <option value="{{ $asas->id }}" {{ old('id_asas') == $asas->id ? 'selected' : '' }}>
                                    {{ $asas->nama_asas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_asas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                            value="{{ old('judul') }}" placeholder="Masukkan judul mading" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gambaran_deskripsi">Gambaran</label>
                        <textarea class="form-control @error('gambaran_deskripsi') is-invalid @enderror" id="gambaran_deskripsi" name="gambaran_deskripsi" rows="4" placeholder="Masukkan deskripsi" required>{{ old('gambaran_deskripsi') }}</textarea>
                        @error('gambaran_deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('mading.index') }}" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
