@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Tahfidz</h4>
                    <p class="card-description">Informasi lengkap tentang tahfidz</p>

                    <div class="mb-3">
                        <strong>Jenis Tahfidz:</strong>
                        <p class="text-muted">{{ $tahfidz->jenis_tahfidz }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Arti:</strong>
                        <p class="text-muted">{{ $tahfidz->arti }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Juz / Ayat:</strong>
                        <p class="text-muted">{{ $tahfidz->juz_ayat }}</p>
                    </div>

                    <a href="{{ route('tahfidz.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
