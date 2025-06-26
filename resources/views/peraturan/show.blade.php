@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Peraturan</h4>
                    <p class="card-description">
                        Informasi lengkap mengenai peraturan yang dipilih
                    </p>

                    <div class="form-group">
                        <label><strong>Nama Peraturan:</strong></label>
                        <p>{{ $peraturan->nama_peraturan }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Jenis Peraturan:</strong></label>
                        <p>{{ ucfirst($peraturan->jenis_peraturan) }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>File:</strong></label>
                        @if ($peraturan->file)
                            <p>
                                <a href="{{ asset('storage/peraturans/' . $peraturan->file) }}" target="_blank">
                                    {{ $peraturan->file }}
                                </a>
                            </p>
                        @else
                            <p><em>Tidak ada file diunggah.</em></p>
                        @endif
                    </div>

                    <a href="{{ route('peraturan.index') }}" class="btn btn-light">
                        <i class="ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
