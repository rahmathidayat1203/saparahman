@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Jenis Fiqih</h4>
                <p class="card-description">Form untuk mengubah data jenis fiqih</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('fiqih.update', $fiqih->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="jenis_fiqih">Jenis Fiqih</label>
                        <input type="text" name="jenis_fiqih" class="form-control" value="{{ old('jenis_fiqih', $fiqih->jenis_fiqih) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="mdi mdi-pencil"></i> Update
                    </button>
                    <a href="{{ route('fiqih.index') }}" class="btn btn-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
