@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Tahfidz</h4>
                    <p class="card-description">Perbarui data tahfidz di bawah ini</p>

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

                    <form action="{{ route('tahfidz.update', $tahfidz->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="jenis_tahfidz">Jenis Tahfidz</label>
                            <input type="text" class="form-control" id="jenis_tahfidz" name="jenis_tahfidz" value="{{ old('jenis_tahfidz', $tahfidz->jenis_tahfidz) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="arti">Arti</label>
                            <input type="text" class="form-control" id="arti" name="arti" value="{{ old('arti', $tahfidz->arti) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="juz_ayat">Juz / Ayat</label>
                            <input type="text" class="form-control" id="juz_ayat" name="juz_ayat" value="{{ old('juz_ayat', $tahfidz->juz_ayat) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('tahfidz.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
