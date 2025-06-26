@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Tahfidz</h4>
                    <p class="card-description">Silakan lengkapi form berikut</p>

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

                    <form action="{{ route('tahfidz.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="jenis_tahfidz">Jenis Tahfidz</label>
                            <input type="text" class="form-control" id="jenis_tahfidz" name="jenis_tahfidz" placeholder="Contoh: Juz Amma" value="{{ old('jenis_tahfidz') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="arti">Arti</label>
                            <input type="text" class="form-control" id="arti" name="arti" placeholder="Contoh: Penghafal Juz 30" value="{{ old('arti') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="juz_ayat">Juz / Ayat</label>
                            <input type="text" class="form-control" id="juz_ayat" name="juz_ayat" placeholder="Contoh: Juz 30 / QS. An-Naba: 1–40" value="{{ old('juz_ayat') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('tahfidz.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
