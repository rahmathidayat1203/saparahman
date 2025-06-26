@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Kandungan Mading</h4>

                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">ID Asas:</div>
                    <div class="col-md-8">{{ $kandunganMading->id_asas }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">Nama Guru Pengampu:</div>
                    <div class="col-md-8">{{ $kandunganMading->nama_pengampu }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">Judul:</div>
                    <div class="col-md-8">{{ $kandunganMading->judul }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">File:</div>
                    <div class="col-md-8">
                        @if ($kandunganMading->file)
                            <a href="{{ asset('storage/' . $kandunganMading->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="mdi mdi-file-document"></i> Lihat File
                            </a>
                        @else
                            <span class="badge bg-secondary">Tidak ada file</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 font-weight-bold">Gambaran:</div>
                    <div class="col-md-8">
                        <div class="p-3 border rounded bg-light">
                            {!! nl2br(e($kandunganMading->desk)) !!}
                        </div>
                    </div>
                </div>

                <a href="{{ route('kandungan-mading.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
