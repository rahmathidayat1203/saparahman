@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Master Mapel</h4>

                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Nama Mapel</label>
                    <input type="text" class="form-control" id="nama_mapel" value="{{ $master__mapel->nama_mapel }}" disabled>
                </div>

                <a href="{{ route('master_mapel.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
