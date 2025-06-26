@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Hafalan Inggris</h2>

    <div class="mb-3">
        <label class="form-label">Santri</label>
        <p>{{ $hafalanInggris->santri->nama_santri ?? '-' }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Subjek</label>
        <p>{{ $hafalanInggris->inggris->subjek ?? '-' }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Setoran</label>
        <p>{{ $hafalanInggris->tgl_setoran }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Nilai</label>
        <p>{{ $hafalanInggris->nilai }}</p>
    </div>

    <a href="{{ route('hafalan-inggris.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
