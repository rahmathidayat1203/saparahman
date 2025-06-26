@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Subjek Bahasa Inggris</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input:<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('inggris.update', $inggris->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="subjek" class="form-label">Subjek</label>
                        <input type="text" class="form-control" name="subjek" value="{{ old('subjek', $inggris->subjek) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save-edit"></i> Perbarui
                    </button>
                    <a href="{{ route('inggris.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
