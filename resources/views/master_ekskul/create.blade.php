@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Ekskul</h4>

                <form action="{{ route('master_ekskul.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_ekskul">Nama Ekskul</label>
                        <input type="text" class="form-control @error('nama_ekskul') is-invalid @enderror" id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul') }}" required>
                        @error('nama_ekskul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('master_ekskul.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
