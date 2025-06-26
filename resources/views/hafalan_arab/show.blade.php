@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Hafalan Arab</h2>

    <div class="mb-3">
        <strong>Santri:</strong> {{ $hafalanArab->santri->nama_santri ?? '-' }}
    </div>

    <div class="mb-3">
        <strong>Subjek:</strong> {{ $hafalanArab->arab->subjek ?? '-' }}
    </div>

    <div class="mb-3">
        <strong>Tanggal Setoran:</strong> {{ $hafalanArab->tgl_setoran }}
    </div>

    <div class="mb-3">
        <strong>Nilai:</strong> {{ $hafalanArab->nilai }}
    </div>

    <a href="{{ route('hafalan-arab.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
