@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Master Mapel</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input:<br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('master_mapel.update', $master__mapel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_mapel" class="form-label">Nama Mapel</label>
                        <input type="text" 
                               name="nama_mapel" 
                               id="nama_mapel"
                               class="form-control @error('nama_mapel') is-invalid @enderror" 
                               value="{{ old('nama_mapel', $master__mapel->nama_mapel) }}" 
                               required>
                        @error('nama_mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>
                    <a href="{{ route('master_mapel.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
