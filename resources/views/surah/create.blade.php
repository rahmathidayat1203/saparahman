@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Surah</h4>
                <p class="card-description">Lengkapi data surah berikut dengan benar.</p>

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

                <form action="{{ route('surah.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_surah" class="form-label fw-bold">Nama Surah</label>
                        <input type="text" class="form-control" name="nama_surah" value="{{ old('nama_surah') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="arti_surah" class="form-label fw-bold">Arti Surah</label>
                        <input type="text" class="form-control" name="arti_surah" value="{{ old('arti_surah') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jml_ayat" class="form-label fw-bold">Jumlah Ayat</label>
                        <input type="number" class="form-control" name="jml_ayat" value="{{ old('jml_ayat') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('surah.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
