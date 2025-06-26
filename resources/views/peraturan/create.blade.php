@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Peraturan</h4>
                    <p class="card-description">
                        Formulir untuk menambah peraturan baru
                    </p>

                    <form class="forms-sample" action="{{ route('peraturan.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_peraturan">Nama Peraturan</label>
                            <input type="text" class="form-control @error('nama_peraturan') is-invalid @enderror"
                                id="nama_peraturan" name="nama_peraturan" placeholder="Masukkan nama peraturan"
                                value="{{ old('nama_peraturan') }}" required>
                            @error('nama_peraturan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_peraturan">Jenis Peraturan</label>
                            <select name="jenis_peraturan" id="jenis_peraturan"
                                class="form-control @error('jenis_peraturan') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Peraturan --</option>
                                <option value="peraturan umum"
                                    {{ old('jenis_peraturan') == 'peraturan umum' ? 'selected' : '' }}>Peraturan Umum
                                </option>
                                <option value="peraturan agama"
                                    {{ old('jenis_peraturan') == 'peraturan agama' ? 'selected' : '' }}>Peraturan Agama
                                </option>
                                <option value="peraturan sekolah"
                                    {{ old('jenis_peraturan') == 'peraturan sekolah' ? 'selected' : '' }}>Peraturan Sekolah
                                </option>
                                <option value="peraturan asrama"
                                    {{ old('jenis_peraturan') == 'peraturan asrama' ? 'selected' : '' }}>Peraturan Asrama
                                </option>
                            </select>
                            @error('jenis_peraturan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>File Upload</label>
                            <input type="file" name="file"
                                class="file-upload-default @error('file') is-invalid @enderror">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload File">
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
                                Format yang diperbolehkan: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Simpan
                        </button>
                        <a href="{{ route('peraturan.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.file-upload-browse').on('click', function() {
                var file = $(this).closest('.form-group').find('.file-upload-default');
                file.trigger('click');
            });

            $('.file-upload-default').on('change', function() {
                $(this).closest('.form-group').find('.file-upload-info').val($(this).val().replace(
                    /C:\\fakepath\\/i, ''));
            });
        });
    </script>
@endpush
