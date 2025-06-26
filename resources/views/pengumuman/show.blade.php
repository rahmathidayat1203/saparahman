@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Detail Pengumuman</h4>

                    <div class="mb-3">
                        <strong>Judul:</strong>
                        <p class="text-muted">{{ $pengumuman->judul }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p class="text-muted">{{ $pengumuman->desk }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>File:</strong><br>
                        <a href="{{ asset('storage/pengumumans/' . $pengumuman->file) }}" target="_blank">
                            {{ $pengumuman->file }}
                        </a>
                    </div>

                    <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
