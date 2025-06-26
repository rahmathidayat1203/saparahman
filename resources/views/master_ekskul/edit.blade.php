@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Ekskul</h4>

                <form action="{{ route('master_ekskul.update', $master_ekskul->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_ekskul">Nama Ekskul</label>
                        <input type="text" class="form-control @error('nama_ekskul') is-invalid @enderror" id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul', $master_ekskul->nama_ekskul) }}" required>
                        @error('nama_ekskul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>
                    <a href="{{ route('master_ekskul.index') }}" class="btn btn-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
