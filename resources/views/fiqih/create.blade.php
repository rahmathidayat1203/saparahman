@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Jenis Fiqih</h4>
                <p class="card-description">Form untuk menambahkan jenis fiqih baru</p>

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

                <form action="{{ route('fiqih.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="jenis_fiqih">Jenis Fiqih</label>
                        <input type="text" name="jenis_fiqih" class="form-control" value="{{ old('jenis_fiqih') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('fiqih.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
