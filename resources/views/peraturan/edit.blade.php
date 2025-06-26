@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Peraturan</h4>
                    <p class="card-description">
                        Formulir untuk mengubah data peraturan
                    </p>

                    <form class="forms-sample" action="{{ route('peraturan.update', $peraturan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_peraturan">Nama Peraturan</label>
                            <input type="text" class="form-control @error('nama_peraturan') is-invalid @enderror"
                                id="nama_peraturan" name="nama_peraturan"
                                value="{{ old('nama_peraturan', $peraturan->nama_peraturan) }}" required>
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
                                    {{ old('jenis_peraturan', $peraturan->jenis_peraturan) == 'peraturan umum' ? 'selected' : '' }}>
                                    Peraturan Umum</option>
                                <option value="peraturan agama"
                                    {{ old('jenis_peraturan', $peraturan->jenis_peraturan) == 'peraturan agama' ? 'selected' : '' }}>
                                    Peraturan Agama</option>
                                <option value="peraturan sekolah"
                                    {{ old('jenis_peraturan', $peraturan->jenis_peraturan) == 'peraturan sekolah' ? 'selected' : '' }}>
                                    Peraturan Sekolah</option>
                                <option value="peraturan asrama"
                                    {{ old('jenis_peraturan', $peraturan->jenis_peraturan) == 'peraturan asrama' ? 'selected' : '' }}>
                                    Peraturan Asrama</option>
                            </select>
                            @error('jenis_peraturan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
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
                                Format yang diperbolehkan: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)
                            </small>

                            @if ($peraturan->file)
                                <p class="mt-3">
                                    File saat ini:
                                    <a href="{{ asset('storage/peraturans/' . $peraturan->file) }}" target="_blank">
                                        {{ $peraturan->file }}
                                    </a>
                                </p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Update
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
