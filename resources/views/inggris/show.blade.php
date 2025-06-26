@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Subjek Bahasa Inggris</h4>
                <div class="mb-3">
                    <label class="form-label fw-bold">Subjek:</label>
                    <p class="form-control-plaintext">{{ $inggris->subjek }}</p>
                </div>
                <a href="{{ route('inggris.index') }}" class="btn btn-secondary mt-3">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
