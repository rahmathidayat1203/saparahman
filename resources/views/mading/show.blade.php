@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Mading</h2>

    <div class="mb-3">
        <strong>ID Kategori Mading:</strong>
        <p>{{ $mading->id_kategori_mading }}</p>
    </div>

    <div class="mb-3">
        <strong>ID Asas:</strong>
        <p>{{ $mading->id_asas }}</p>
    </div>

    <div class="mb-3">
        <strong>Judul:</strong>
        <p>{{ $mading->judul }}</p>
    </div>

    <div class="mb-3">
        <strong>Gambar:</strong><br>
        <img src="{{ asset('storage/' . $mading->gambar) }}" alt="Gambar" width="200">
        <p>{{ $mading->gambar }}</p>
    </div>

    <div class="mb-3">
        <strong>Gambaran:</strong>
        <p>{{ $mading->gambaran }}</p>
    </div>

    <a href="{{ route('mading.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
