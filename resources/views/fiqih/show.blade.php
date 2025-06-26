@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Jenis Fiqih</h4>
                <div class="mb-3">
                    <strong>Jenis Fiqih:</strong>
                    <p class="mb-0">{{ $fiqih->jenis_fiqih }}</p>
                </div>
                <a href="{{ route('fiqih.index') }}" class="btn btn-secondary mt-3">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
