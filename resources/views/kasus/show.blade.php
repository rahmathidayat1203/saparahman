@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kasus Pelanggaran</h4>
                    <p class="card-description">Informasi lengkap tentang pelanggaran yang terjadi</p>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Santri:</label>
                        <p>{{ $kasus->santri->nama_santri ?? 'Tidak Diketahui' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Pelanggaran:</label>
                        <p>{{ $kasus->jenisKasus->jenis_kasus ?? 'Tidak Diketahui' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Kejadian:</label>
                        <p>{{ \Carbon\Carbon::parse($kasus->tgl_kejadian)->translatedFormat('d F Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan Pelanggaran:</label>
                        <p>{{ $kasus->ket_pelanggaran }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Penyelesaian:</label>
                        <p>{{ $kasus->desc_penyelesaian }}</p>
                    </div>

                    <a href="{{ route('kasus.index') }}" class="btn btn-light">
                        <i class="ti-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('kasus.edit', $kasus->id) }}" class="btn btn-warning">
                        <i class="ti-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
