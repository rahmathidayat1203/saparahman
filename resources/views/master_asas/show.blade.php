@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Detail Master Asas</h4>

                <div class="form-group">
                    <label><strong>Nama Asas:</strong></label>
                    <p class="mt-2">{{ $masterAsas->nama_asas }}</p>
                </div>

                <a href="{{ route('master-asas.index') }}" class="btn btn-light mt-3">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
