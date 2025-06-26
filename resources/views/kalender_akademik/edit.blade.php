@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Edit Kalender Akademik</h2>
    <form method="POST" action="{{ route('kalender_akademik.update', $kalenderAkademik->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kalenderAkademik->tanggal_mulai) }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kalenderAkademik->tanggal_selesai) }}">
        </div>

        <select name="libur_akademik" class="form-control">
            <option value="">-- Pilih Jenis Libur --</option>
            <option value="Acara Khusus" {{ $kalenderAkademik->libur_akademik == 'Acara Khusus' ? 'selected' : '' }}>Acara Khusus</option>
            <option value="PTS" {{ $kalenderAkademik->libur_akademik == 'PTS' ? 'selected' : '' }}>PTS</option>
            <option value="PAS" {{ $kalenderAkademik->libur_akademik == 'PAS' ? 'selected' : '' }}>PAS</option>
            <option value="Hari Libur" {{ $kalenderAkademik->libur_akademik == 'Hari Libur' ? 'selected' : '' }}>Hari Libur</option>
        </select>        

        <div class="mb-3">
            <label for="tahun_ajaran">Tahun Ajaran</label>
            <input type="text" class="form-control" name="tahun_ajaran" value="{{ old('tahun_ajaran', $kalenderAkademik->tahun_ajaran) }}">
        </div>

        <div class="mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" name="keterangan">{{ old('keterangan', $kalenderAkademik->keterangan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('detail-nilai-raport.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
