@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Surah</h4>
                <p class="card-description">Informasi lengkap mengenai surah</p>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Surah:</label>
                    <div>{{ $surah->nama_surah }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Arti Surah:</label>
                    <div>{{ $surah->arti_surah }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Ayat:</label>
                    <div>{{ $surah->jml_ayat }}</div>
                </div>

                <a href="{{ route('surah.index') }}" class="btn btn-secondary mt-3">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
