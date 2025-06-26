@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Orang Tua</h2>

    <div class="mb-3">
        <label><strong>Nama Orang Tua:</strong></label>
        <div>{{ $orangtua->nama_ortu }}</div>
    </div>
    <div class="mb-3">
        <label><strong>No KK:</strong></label>
        <div>{{ $orangtua->no_kk }}</div>
    </div>
    <div class="mb-3">
        <label><strong>No Telepon:</strong></label>
        <div>{{ $orangtua->no_telepon }}</div>
    </div>
    <div class="mb-3">
        <label><strong>Alamat:</strong></label>
        <div>{{ $orangtua->alamat }}</div>
    </div>
    <div class="mb-3">
        <label><strong>Pekerjaan:</strong></label>
        <div>{{ $orangtua->pekerjaan }}</div>
    </div>

    <a href="{{ route('orangtua.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
