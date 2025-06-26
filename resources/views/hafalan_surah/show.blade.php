@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Hafalan Surah</h2>

    <div class="mb-3">
        <strong>Santri:</strong> {{ $hafalanSurah->santri->nama_santri ?? '-' }}
    </div>

    <div class="mb-3">
        <strong>Surah:</strong> {{ $hafalanSurah->surah->nama_surah ?? '-' }}
    </div>

    <div class="mb-3">
        <strong>Tanggal Setoran:</strong> {{ $hafalanSurah->tgl_setoran }}
    </div>

    <div class="mb-3">
        <strong>Nilai:</strong> {{ $hafalanSurah->nilai }}
    </div>

    <a href="{{ route('hafalan-surah.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
