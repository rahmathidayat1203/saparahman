@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Subjek Bahasa Arab</h4>

                <form action="{{ route('arab.store') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="subjek">Subjek</label>
                        <input type="text" name="subjek" class="form-control" id="subjek" value="{{ old('subjek') }}" required>
                        @error('subjek')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success me-2">Simpan</button>
                    <a href="{{ route('arab.index') }}" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
