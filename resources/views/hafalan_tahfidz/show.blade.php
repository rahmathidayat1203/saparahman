@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Hafalan Tahfidz</h2>

    <div class="mb-3">
        <strong>Santri:</strong> {{ $hafalanTahfidz->santri->nama_santri ?? '-' }}
    </div>

    <div class="mb-3">
        <strong>Jenis Hafalan:</strong> {{ $hafalanTahfidz->tahfidz->jenis_tahfidz ?? '-' }}
    </div>

    <div class="mb-3">
        <strong>Tanggal Setoran:</strong> {{ $hafalanTahfidz->tgl_setoran }}
    </div>

    <div class="mb-3">
        <strong>Nilai:</strong> {{ $hafalanTahfidz->nilai }}
    </div>

    <a href="{{ route('hafalan-tahfidz.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
