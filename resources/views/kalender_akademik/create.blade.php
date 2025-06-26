@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Tambah Kalender Akademik</h2>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan dalam input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kalender_akademik.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
        </div>

        <div class="mb-3">
            <label for="libur_akademik" class="form-label">Libur Akademik</label>
            <select name="libur_akademik" class="form-control">
                <option value="">-- Pilih Jenis Libur --</option>
                <option value="Acara Khusus" {{ old('libur_akademik') == 'Acara Khusus' ? 'selected' : '' }}>Acara Khusus</option>
                <option value="PTS" {{ old('libur_akademik') == 'PTS' ? 'selected' : '' }}>PTS</option>
                <option value="PAS" {{ old('libur_akademik') == 'PAS' ? 'selected' : '' }}>PAS</option>
                <option value="Hari Libur" {{ old('libur_akademik') == 'Hari Libur' ? 'selected' : '' }}>Hari Libur</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <input type="text" class="form-control" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}">
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kalender_akademik.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
