@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Kelas</h4>

                <div class="mb-3">
                    <label class="form-label fw-bold">ID:</label>
                    <p class="form-control-plaintext">{{ $kelas->id }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tingkatan:</label>
                    <p class="form-control-plaintext">{{ $kelas->tingkatan }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tingkat Kelas:</label>
                    <p class="form-control-plaintext">{{ $kelas->tingkat_kelas }}</p>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Kelas:</label>
                    <p class="form-control-plaintext">{{ $kelas->nama_kelas }}</p>
                </div>

                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
