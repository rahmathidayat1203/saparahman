@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Pengumuman</h4>
                    <p class="card-description">
                        Formulir untuk mengedit pengumuman
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada kesalahan dalam input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="forms-sample" action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul">Judul Pengumuman</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="desk">Deskripsi</label>
                            <textarea class="form-control @error('desk') is-invalid @enderror" id="desk" name="desk" rows="4"
                                required>{{ old('desk', $pengumuman->desk) }}</textarea>
                            @error('desk')
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
                            @if ($pengumuman->file)
                                <small class="form-text text-muted mt-2">
                                    File saat ini:
                                    <a href="{{ asset('storage/pengumuman/' . $pengumuman->file) }}" target="_blank">
                                        {{ $pengumuman->file }}
                                    </a>
                                </small>
                            @endif
                            <small class="form-text text-muted">
                                Format yang diperbolehkan: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Update
                        </button>
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Batal
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
                $(this).closest('.form-group').find('.file-upload-info')
                    .val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
        });
    </script>
@endpush
