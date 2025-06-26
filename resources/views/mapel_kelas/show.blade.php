@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h1>Detail Mapel Kelas</h1>

    <div class="mb-3">
        <label class="form-label">Nama Kelas</label>
        <p class="form-control">{{ $mapel_kelas->nama_kelas }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">ID Master Mapel</label>
        <p class="form-control">{{ $mapel_kelas->id_master_mapel }}</p>
    </div>

    <a href="{{ route('mapel_kelas.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
