@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Subjek Bahasa Arab</h4>

                <div class="form-group">
                    <label class="form-label fw-bold">Subjek:</label>
                    <p class="mt-1">{{ $arab->subjek }}</p>
                </div>

                <a href="{{ route('arab.index') }}" class="btn btn-light mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
