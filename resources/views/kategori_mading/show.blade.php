@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Kategori Mading</h2>

    <div class="mb-3">
        <strong>Nama Kategori:</strong>
        <p>{{ $kategoriMading->kategori }}</p>
    </div>

    <a href="{{ route('kategori-mading.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
