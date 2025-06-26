@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Pengumuman</h4>
                    <p class="card-description">
                        Formulir untuk menambah pengumuman baru
                    </p>

                    <form class="forms-sample" action="{{ route('pengumuman.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul Pengumuman</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" placeholder="Masukkan judul pengumuman" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="desk">Deskripsi</label>
                            <textarea class="form-control @error('desk') is-invalid @enderror" id="desk" name="desk" rows="4"
                                placeholder="Masukkan deskripsi pengumuman" required>{{ old('desk') }}</textarea>
                            @error('desk')
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
                                <div class="invalid-feedback">
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
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-light">
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
            // File upload functionality
            $('.file-upload-browse').on('click', function() {
                var file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });

            $('.file-upload-default').on('change', function() {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
        });
    </script>
@endpush
