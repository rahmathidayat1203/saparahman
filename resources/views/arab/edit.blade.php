@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Subjek Bahasa Arab</h4>

                <form action="{{ route('arab.update', $arab->id) }}" method="POST" class="forms-sample">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="subjek">Subjek</label>
                        <input type="text" name="subjek" class="form-control" id="subjek" value="{{ old('subjek', $arab->subjek) }}" required>
                        @error('subjek')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                    <a href="{{ route('arab.index') }}" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
