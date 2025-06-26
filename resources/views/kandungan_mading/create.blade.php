@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Kandungan Mading</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada kesalahan pada input.<br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kandungan-mading.store') }}" method="POST" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf

                        <div class="form-group">
                            <label for="id_asas">Asas <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_asas') is-invalid @enderror" id="id_asas"
                                name="id_asas" required>
                                <option value="">-- Pilih Asas --</option>
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
                            <label for="nama_pengampu">Nama Guru Pengampu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_pengampu') is-invalid @enderror"
                                id="nama_pengampu" name="nama_pengampu" value="{{ old('nama_pengampu') }}" required>
                            @error('nama_pengampu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pdf_file">Upload File PDF <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('pdf_file') is-invalid @enderror"
                                id="pdf_file" name="pdf_file" accept=".pdf" required>
                            @error('pdf_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Hanya format PDF yang diperbolehkan. Maksimal 2MB.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="png_file">Upload Gambar PNG</label>
                            <input type="file" class="form-control @error('png_file') is-invalid @enderror"
                                id="png_file" name="png_file" accept="image/png">
                            @error('png_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Hanya format PNG yang diperbolehkan. Maksimal 2MB. (Opsional)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="desk">Gambaran <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('desk') is-invalid @enderror" id="desk" name="desk" rows="5"
                                required>{{ old('desk') }}</textarea>
                            @error('desk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="mdi mdi-content-save"></i> Simpan
                            </button>
                            <a href="{{ route('kandungan-mading.index') }}" class="btn btn-light">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function validateFile(input, allowedTypes, maxSize, fileType) {
                const file = input.files[0];
                if (file) {
                    if (file.size > maxSize) {
                        alert(`Ukuran file ${fileType} melebihi 2MB!`);
                        input.value = '';
                        return false;
                    }
                    if (!allowedTypes.includes(file.type)) {
                        alert(`Hanya file ${fileType} yang diperbolehkan!`);
                        input.value = '';
                        return false;
                    }
                }
                return true;
            }

            document.getElementById('pdf_file').addEventListener('change', function(e) {
                validateFile(e.target, ['application/pdf'], 2 * 1024 * 1024, 'PDF');
            });

            document.getElementById('png_file').addEventListener('change', function(e) {
                validateFile(e.target, ['image/png'], 2 * 1024 * 1024, 'PNG');
            });
        </script>
    </div>
@endsection
